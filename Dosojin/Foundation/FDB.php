<?php

/**
 * @access public
 * @package Foundation
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 * classe di partenza per i medodi del package foundation, i quali la estendono per avere a disposizione la connettivitÃ  al database
 */
class FDB
{
    /**
     * @var PDO $connection oggetto rappresentante la connessione al database
     */
    private PDO $connection;
    /**
     * @var string $tableName nome della tabella sulla quale agisce la classe
     */
    protected string $tableName;
    /**
     * @var array $paramNames array contenente nomi delle colonne nel db
     */
    protected array $paramNames;
    /**
     * @var string $returnType tipo dell'oggetto da restituire nella ricerca
     */
    protected string $returnType;

    /**
     * 1 - recupera i dati per la connessione al db dall'array gloabale di configurazione
     * 2 - chiama il metodo connect per connetterti al database
     */
    public function __construct()
    {
        global $config;
        $this->connect($config['mysql']['host'], $config['mysql']['user'], $config['mysql']['password'], $config['mysql']['database']);
    }

    /**
     * estrae da un oggetto tutti i parametri eespressi nell'array contenti i loro nomi e li restituisce come array
     *
     * @param $obj
     * @return array
     */
    public function extractParams($obj): array
    {
        $parameters = array();
        foreach ($this->paramNames as $param) {
            $parameters[$param] = $obj->$param;
        }
        return $parameters;
    }

    /**
     * dato il risultato di una quesry lo trasforma in un array di oggetti del tipo della classe figlia
     *
     * @param array $arr
     * @return array
     */
    private function Arr2Obj(array $arr): array
    {
        $obj = array();
        $c = 0;
        foreach ($arr as $a) {
            $obj[$c] = new $this->returnType();
            foreach ($a as $key => $value) {
                $obj[$c]->$key = $value;
            }
            $c++;
        }
        return $obj;
    }

    /**
     * inizializza la connessione al database secondo i parametri passati
     *
     * @param String $host locazione del database
     * @param String $username nome utente per l'accesso
     * @param String $password password per l'accesso
     * @param string $db nome del database
     */
    private function connect(string $host, string $username, string $password, string $db)
    {
        $this->connection = new PDO('mysql:host=' . $host . ';dbname=' . $db, $username, $password); //portable data object

    }

    /**
     * 1 - recupera i parametri dall'oggetto
     * 2 - componi la stringa per la query
     * 3 - chiama il metodo query per salvare la riga
     *
     * @param $obj
     *
     */
    public function store($obj)
    {
        $params = $this->extractParams($obj);
        $query = 'INSERT INTO ' . $this->tableName . '(';
        foreach ($params as $key => $value) {
            $query = $query . $key . ",";
        }
        $query = rtrim($query, ',') . ') VALUES (';
        for ($i = 0; $i < count($params); $i++) {
            $query = $query . "?,";
        }
        $query = rtrim($query, ',') . ')';
        $this->query($query, array_values($params), false);

    }

    /**
     * 1 - recupera i parametri dall'array di chiavi-valori da aggiornare
     * 2 - componi la stringa per la query
     * 3 - chiama il metodo query per aggiornare la riga
     *
     * @param array $keys la/le chiave/i primaria/e della tabella ed i relativi valori
     * @param $obj
     */
    public function update($obj, array $keys)
    {
        $params = $this->extractParams($obj);
        $query = 'UPDATE ' . $this->tableName . ' SET ';
        foreach ($params as $key => $value) {
            $query = $query . $key . "=?,";
        }
        $query = rtrim($query, ',') . ' WHERE ';
        foreach ($keys as $key => $value) {
            $query = $query . $key . "=?" . ' AND ';
        }
        $query = rtrim($query, ' AND ');
        $this->query($query, array_merge(array_values($params), array_values($keys)), false);
    }

    /**
     * 1 - recupera i parametri dall'array di chiavi-valori di cui verificare l'esistenza
     * 2 - effettua la query di ricerca per i dati paramentri
     * 3 - restituisce true se la query non Ã¨ vuota
     *
     * @param array $keys la lista delle coppie chiave valore da cercare
     * @return boolean
     */
    public function exists(array $keys): bool
    {
        $query = 'SELECT * FROM ' . $this->tableName . ' WHERE ';
        foreach ($keys as $key => $value) {
            $query = $query . $key . "=? AND ";
        }
        $query = rtrim($query, ' AND ');

        return count($this->query($query, array_values($keys), true)) > 0;
    }

    /**
     * 1 - recupera i parametri dall'array di chiavi-valori da cercare
     * 2 - effettua la query di ricerca per i dati paramentri
     * 3 - restituisce la lista di righe trovata
     *
     * @param array $where lista di coppie chiave-valore contenenti le clausole per la ricerca
     * @param array $order lista dei valori in base al quale ordinare
     * @param bool $obj
     * @return array
     */
    public function search(array $where, array $order = array(), bool $obj = true): array
    {
        $query = 'SELECT * FROM ' . $this->tableName . ' WHERE ';
        foreach ($where as $key => $value) {
            $query = $query . $key . "=? AND ";
        }
        $query = rtrim($query, ' AND ');
        if (count($order) > 0) {
            $query = $query . ' ORDER BY ';
            foreach ($order as $value) {
                $query = $query . $value . ', ';
            }
            $query = rtrim($query, ', ');
        }
        if ($obj)
            return $this->Arr2Obj($this->query($query, array_values($where), true));
        else
            return $this->query($query, array_values($where), true);

    }

    /**
     * 1 - recupera i parametri dall'array di chiavi-valori da eliminare
     * 2 - effettua la query di ricerca per i dati paramentri
     *
     * @param array $where lista di coppie chiave-valore contenenti le clausole per la ricerca
     */
    public function delete(array $where)
    {
        $query = 'DELETE FROM ' . $this->tableName . ' WHERE ';
        foreach ($where as $key => $value) {
            $query = $query . $key . "=? AND ";
        }
        $query = rtrim($query, ' AND ');
        $this->query($query, array_values($where), false);


    }

    /**
     * 1 - esegue una query al database, preparandola
     * 2 - restituisce il risultati se richiesto
     *
     * @param string $query query pronta per essere preparata
     * @param array $param lista dei parametri da collegare
     * @param boolean $return se restituire o meno un risultato
     * @return array|null
     */
    private function query(string $query, array $param, bool $return): array|null
    {
        $stmt = $this->connection->prepare($query);

        for ($i = 1; $i <= count($param); $i++) {
            $stmt->bindValue($i, $param[$i - 1]);
        }
        $stmt->execute();
        if ($return)
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        else
            return null;
    }
}
