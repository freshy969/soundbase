CREATE TABLE member (
    id                     INTEGER PRIMARY KEY AUTO_INCREMENT,
    email                  VARCHAR(254) NOT NULL UNIQUE,
    name                   VARCHAR(60),
    username               VARCHAR(20) NOT NULL UNIQUE,
    birthday               DATE,
    password               CHAR(60),
    registration_date      DATE,
    profile_photo_filename VARCHAR(100) DEFAULT 'photo.png',
    cover_photo_filename   VARCHAR(100) DEFAULT 'cover.png',
    position               INTEGER DEFAULT 0,
    description            TEXT,
    token                  VARCHAR(64)
) CHARSET=utf8;

CREATE TABLE subscription (
    member_following VARCHAR(254) REFERENCES member (id),
    member_followed  VARCHAR(254) REFERENCES member (id),
    PRIMARY KEY (member_following, member_followed)
) CHARSET=utf8;

CREATE TABLE track (
    id               INTEGER PRIMARY KEY AUTO_INCREMENT,
    title            VARCHAR(60),
    description      TEXT,
    genre            VARCHAR(30),
    track_filename   VARCHAR(100),
    photo_filename   VARCHAR(100),
    publication_date DATE,
    member           INTEGER NOT NULL REFERENCES member (id)
);

CREATE TABLE playlist (
    id     INTEGER PRIMARY KEY AUTO_INCREMENT,
    name   VARCHAR(60),
    member INTEGER NOT NULL REFERENCES member (id)
);

CREATE TABLE inclusion (
    playlist INTEGER REFERENCES playlist (id),
    track    INTEGER REFERENCES track (id),
    PRIMARY KEY (playlist, track)
);

CREATE TABLE post (
    id               INTEGER PRIMARY KEY AUTO_INCREMENT,
    content          TEXT,
    publication_date DATE,
    member           INTEGER NOT NULL UNIQUE REFERENCES member (id)
);

CREATE TABLE comment (
    id               INTEGER PRIMARY KEY AUTO_INCREMENT,
    content          TEXT,
    publication_date DATE,
    post             INTEGER NOT NULL UNIQUE REFERENCES post (id),
    member           INTEGER NOT NULL UNIQUE REFERENCES member (id)
);

CREATE TABLE events (
    id                  INTEGER PRIMARY KEY AUTO_INCREMENT,
    name                VARCHAR(60),
    description         TEXT,
    capacity            INTEGER,
    event_date          DATE,
    background_filename VARCHAR(100),
    member              INTEGER NOT NULL REFERENCES member (id)
);

CREATE TABLE registration (
    member  VARCHAR(254) REFERENCES MEMBRE (id),
    events INTEGER REFERENCES events (id),
    PRIMARY KEY (member, events)
) CHARSET=utf8;
