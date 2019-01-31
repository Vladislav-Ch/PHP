create database car_rental;

use car_rental;

create table if not exists clients(
	id int not null auto_increment
	,surname nvarchar(45) not null
	,name nvarchar(45) not null
    ,patronymic nvarchar(45) not null
    ,passport nvarchar(45) not null
	,primary key(id)
);

create table if not exists model_car(
	id int not null auto_increment
    ,model nvarchar(45) not null
    ,primary key(id)
);

create table if not exists color(
	id int not null auto_increment
    ,color nvarchar(45) not null
    ,primary key(id)
);

create table if not exists car(
	id int not null auto_increment
    ,id_model_car int not null
    ,id_color int not null
    ,year int not null
    ,gos_nomer nvarchar(45) not null
    ,insurance_value double not null
    ,cost_one_day int not null
    ,primary key(id)
    ,foreign key(id_model_car) references model_car(id)
    ,foreign key(id_color) references color(id)
);

create table if not exists rental(
	id int not null auto_increment
    ,id_client int not null
    ,id_car int not null
    ,start_dat date not null
    ,count_day int not null
    ,primary key(id)
    ,foreign key(id_client) references clients(id)
    ,foreign key(id_car) references car(id)
);