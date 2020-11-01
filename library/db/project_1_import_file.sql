DROP TABLE IF EXISTS votes;
DROP TABLE IF EXISTS solutions;
DROP TABLE IF EXISTS problems;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS categories;

CREATE TABLE IF NOT EXISTS users
(
    id          SERIAL PRIMARY KEY,
    first_name  TEXT        NOT NULL,
    last_name   TEXT        NOT NULL,
    email       TEXT UNIQUE NOT NULL,
    summary     TEXT,
    password    TEXT        NOT NULL,
    level       INT         NOT NULL,
    created_at  TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_at TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS categories
(
    id          SERIAL PRIMARY KEY,
    name        TEXT      NOT NULL,
    created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS problems
(
    id          SERIAL PRIMARY KEY,
    created_by  INTEGER   NOT NULL REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE,
    category_id  INTEGER   NOT NULL REFERENCES categories (id) ON DELETE CASCADE ON UPDATE CASCADE,
    name        TEXT      NOT NULL,
    summary     TEXT      NOT NULL,
    created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS solutions
(
    id          SERIAL PRIMARY KEY,
    created_by  INTEGER   NOT NULL REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE,
    problem_id  INTEGER   NOT NULL REFERENCES problems (id) ON DELETE CASCADE ON UPDATE CASCADE,
    summary     TEXT      NOT NULL,
    created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS votes
(
    id          SERIAL PRIMARY KEY,
    upvote      SMALLINT  NOT NULL,
    voter_id    INTEGER   NOT NULL REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE,
    problem_id  INTEGER REFERENCES problems (id) ON DELETE CASCADE ON UPDATE CASCADE,
    solution_id INTEGER REFERENCES solutions (id) ON DELETE CASCADE ON UPDATE CASCADE,
    created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX ON problems (lower(name));
CREATE INDEX ON problems (lower(summary));
CREATE INDEX ON categories (lower(name));

INSERT INTO categories (id, name)
VALUES (DEFAULT, 'Technology'),
       (DEFAULT, 'Service'),
       (DEFAULT, 'Community'),
       (DEFAULT, 'Product'),
       (DEFAULT, 'Person/Company')
ON CONFLICT (id)
    DO NOTHING;

INSERT INTO users (id, first_name, last_name, email, password, level)
VALUES (DEFAULT, 'Bobby', 'Test', 'bobby@me.com', '$2y$10$36f99L73beJOT0KZNAyjUe7wMCEXUzJIluAgfEZrbgEAWxOa2Q32O', 1),
       (DEFAULT, 'Bill', 'Test', 'bill@me.com', '$2y$10$36f99L73beJOT0KZNAyjUe7wMCEXUzJIluAgfEZrbgEAWxOa2Q32O', 1),
       (DEFAULT, 'Jane', 'Test', 'jane@me.com', '$2y$10$36f99L73beJOT0KZNAyjUe7wMCEXUzJIluAgfEZrbgEAWxOa2Q32O', 1),
       (DEFAULT, 'Jack', 'Test', 'jack@me.com', '$2y$10$36f99L73beJOT0KZNAyjUe7wMCEXUzJIluAgfEZrbgEAWxOa2Q32O', 1),
       (DEFAULT, 'Henry', 'Test', 'henry@me.com', '$2y$10$36f99L73beJOT0KZNAyjUe7wMCEXUzJIluAgfEZrbgEAWxOa2Q32O', 1),
       (DEFAULT, 'Carl', 'Test', 'carl@me.com', '$2y$10$36f99L73beJOT0KZNAyjUe7wMCEXUzJIluAgfEZrbgEAWxOa2Q32O', 1),
       (DEFAULT, 'Steve', 'Test', 'steve@me.com', '$2y$10$36f99L73beJOT0KZNAyjUe7wMCEXUzJIluAgfEZrbgEAWxOa2Q32O', 1),
       (DEFAULT, 'Tyler', 'Test', 'tyler@me.com', '$2y$10$36f99L73beJOT0KZNAyjUe7wMCEXUzJIluAgfEZrbgEAWxOa2Q32O', 1)
ON CONFLICT (id)
    DO NOTHING;

INSERT INTO users (id, first_name, last_name, email, summary, password, level)
VALUES (DEFAULT, 'Joe', 'Test', 'joe@me.com',
        'I have a background in Electrical Engineering and a passion for helping!',
        '$2y$10$36f99L73beJOT0KZNAyjUe7wMCEXUzJIluAgfEZrbgEAWxOa2Q32O', 1),
       (DEFAULT, 'Phil', 'Test', 'phil@me.com',
        'I have a background in Electrical Engineering and a passion for helping!',
        '$2y$10$36f99L73beJOT0KZNAyjUe7wMCEXUzJIluAgfEZrbgEAWxOa2Q32O', 1)
ON CONFLICT (id)
    DO NOTHING;

INSERT INTO problems (id, created_by, name, category_id, summary)
VALUES (DEFAULT, 8, 'Christian Dating App', 1,
        'Looking for a dating site that lets you look for someone of similar values. This would target an audience that is looking for others with similar faith/values.'),
       (DEFAULT, 2, 'House Sitting Service', 2,
        'I am needing people to house sit as I travel often for work. I am willing to pay, but I need someone trusted.'),
        (DEFAULT, 3, 'Shaq is too tall', 5,
        'Shaquille O''Neal, more commonly known as Shaq, is 7'' 1". This is way too tall. He needs to be shorter so we views can watch his games without the camera needing to angle above the game while showing his face. I miss too much of the game and I think he needs to shrink. Please let me know if you have any reasonable solutions!')
ON CONFLICT (id)
    DO NOTHING;

INSERT INTO solutions (id, created_by, problem_id, summary)
VALUES (DEFAULT, 6, 1,
        'Christian Mingle is an online dating service that caters to Christian singles. The service is one of a number of demographically focused online match-making websites operated by Spark Networks. Because of the focus on relationships between Christian singles, Christian Mingle is considered a special-interest online personals site. Former CEO Adam Berger has referred to this type of service as "niche" dating.'),
       (DEFAULT, 3, 2,
        'Trusted House Sitters is a site made to help home owners connect with trusted house sitters. They are available to upkeep your home and watch your pets while you are away. Sitter rates are competitive since you can select from a range of different sitters.')
ON CONFLICT (id)
    DO NOTHING;

INSERT INTO votes (id, upvote, voter_id, problem_id)
VALUES (DEFAULT, 1, 9, 2),
       (DEFAULT, 1, 1, 2),
       (DEFAULT, 1, 4, 2),
       (DEFAULT, 1, 5, 1),
       (DEFAULT, 0, 7, 2),
       (DEFAULT, 0, 6, 1)
ON CONFLICT (id)
    DO NOTHING;

INSERT INTO votes (id, upvote, voter_id, solution_id)
VALUES (DEFAULT, 1, 9, 2),
       (DEFAULT, 1, 1, 2),
       (DEFAULT, 1, 4, 2),
       (DEFAULT, 1, 5, 1),
       (DEFAULT, 0, 7, 2),
       (DEFAULT, 0, 8, 1)
ON CONFLICT (id)
    DO NOTHING;
