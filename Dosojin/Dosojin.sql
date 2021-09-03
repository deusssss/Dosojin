DROP DATABASE IF EXISTS Dosojin;
CREATE DATABASE Dosojin;
CREATE TABLE percorso
(
    id                 INTEGER PRIMARY KEY AUTO_INCREMENT,
    nome               TEXT    NOT NULL,
    creatore           INTEGER NOT NULL REFERENCES utenteEsterno (id),
    approvato          BOOLEAN NOT NULL DEFAULT false,
    visibile           BOOLEAN NOT NULL DEFAULT false,
    luogo              TEXT    NOT NULL,
    descrizione        TEXT    NOT NULL,
    periodoConsigliato TEXT    NOT NULL,
    UNIQUE (nome, creatore)
);
CREATE TABLE tappa
(
    ID_tappa               INTEGER NOT NULL,
    ID_percorso            INTEGER REFERENCES percorso (id),
    nome                   TEXT    NOT NULL,
    indirizzo              TEXT    NOT NULL,
    permanenza_consigliata INTEGER NOT NULL,
    informazioni           TEXT    NOT NULL,
    risorse                TEXT    NOT NULL,
    PRIMARY KEY (ID_tappa, ID_percorso)
);
CREATE TABLE trasporto
(
    ID_trasporto       INTEGER NOT NULL,
    ID_percorso        INTEGER REFERENCES percorso (id),
    mezzo              TEXT    NOT NULL,
    partenza           INTEGER REFERENCES tappa (ID_tappa, ID_percorso),
    arrivo             INTEGER REFERENCES tappa (ID_tappa, ID_percorso),
    informazioni       TEXT    NOT NULL,
    risorse            TEXT    NOT NULL,
    lunghezza_tragitto DOUBLE  NOT NULL,
    ora_partenza       TIME,
    ora_arrivo         TIME,
    PRIMARY KEY (ID_percorso, ID_trasporto)
);
CREATE TABLE commento
(
    id       INTEGER PRIMARY KEY AUTO_INCREMENT,
    utente   INTEGER REFERENCES utenteEsterno (id),
    rating   INTEGER NOT NULL DEFAULT 0,
    testo    TEXT    NOT NULL,
    percorso INTEGER REFERENCES percorso (id),
    data     TEXT    NOT NULL
);

CREATE TABLE utenteEsterno
(
    id              INTEGER PRIMARY KEY AUTO_INCREMENT,
    username        TEXT    NOT NULL UNIQUE,
    password        TEXT    NOT NULL,
    email           TEXT    NOT NULL UNIQUE,
    data_iscrizione DATE    NOT NULL,
    account_attivo  BOOLEAN NOT NULL DEFAULT false,
    nome            TEXT,
    cognome         TEXT,
    informazioni    TEXT,
    tipo            TEXT    NOT NULL,
    profile_picture TEXT    NOT NULL DEFAULT 'ProPic_default.png'
);


CREATE TABLE utenteInterno
(
    id              INTEGER PRIMARY KEY AUTO_INCREMENT,
    username        TEXT    NOT NULL UNIQUE,
    password        TEXT    NOT NULL,
    email           TEXT    NOT NULL UNIQUE,
    account_attivo  BOOLEAN NOT NULL DEFAULT false,
    ruolo           TEXT    NOT NULL,
    profile_picture TEXT    NOT NULL DEFAULT 'ProPic_admin.png'
);


CREATE TABLE percorsiSalvati
(
    ID_utente   INTEGER REFERENCES utenteEsterno (id),
    ID_percorso INTEGER REFERENCES percorso (id),
    PRIMARY KEY (ID_utente, ID_percorso)
);
CREATE TABLE percorsiSeguiti
(
    ID_utente         INTEGER REFERENCES utenteEsterno (id),
    ID_percorso       INTEGER REFERENCES percorso (id),
    ID_tappa_corrente INTEGER REFERENCES tappa (ID_tappa, ID_percorso),
    PRIMARY KEY (ID_utente, ID_percorso)
);

INSERT INTO utenteInterno(username, password, email, account_attivo, ruolo, profile_picture)
VALUES ('admin', '21232f297a57a5a743894a0e4a801fc3', 'deuebiolorenzo@gmail.com', 1, 'amministratore',
        'ProPic_admin.png')