--create table sample1
CREATE TABLE table_sample(
    serial_id serial primary key
    ,title text
    ,body text
    ,publication_date timestamp
    ,add_date timestamp default now()
);

--create table sample2
CREATE TABLE table_name(
    serial_id serial primary key
    ,title text
    ,body text
	,image_url text
    ,flag int
    ,add_date        timestamp default now()
);

--create table sample3
CREATE TABLE dm_log(
    log_id             serial    primary key
    ,id              int
    ,sex             char(1)
    ,dm_id     int
    ,add_date        timestamp default now()
);