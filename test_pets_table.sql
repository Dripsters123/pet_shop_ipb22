USE pet_shop;

INSERT INTO pets (species, name, birth_date, sex) 
VALUES (
    'Šinšila',
    'Nenovērtējamā',
    '2024-02-27',
    'female'
    -- Field 'price' doesn't have a default value
);

INSERT INTO pets (species, name, birth_date, sex, price) 
VALUES (
    'Ļoti garš dzīvnieka sugas nosaukums, kas pārsniedz 50 simbolus', -- Data too long for column 'species'
    'Muris',
    '2023-05-10',
    'male',
    99.99
);

INSERT INTO pets (species, name, birth_date, sex, price) 
VALUES (
    'Kaķis',
    'Muris',
    '10-05-2023', -- Incorrect date value: '10-05-2023' for column 'birth_date'
    'male',
    99.99
);

INSERT INTO pets (species, name, birth_date, sex, price) 
VALUES (
    'Suns',
    'Reksis',
    '2022-08-15',
    'unknown', -- Data truncated for column 'sex'
    150.00
);

INSERT INTO pets (species, name, birth_date, sex, price) 
VALUES (
    'Papagailis',
    'Čirkstulis',
    '2021-12-01',
    'male',
    10000.00 -- Out of range value for column 'price' 
);