create database `MY_DB`;

use `MY_DB`;

-- КЛИЕНТЫ
create table if not exists `Customers`(
	`id` int(11) not null auto_increment
    ,`surname_customers` varchar(45) not null
    ,`name_customers` varchar(45) not null
    ,`patronymic_customers` varchar(45) not null
    ,`passport_ciustomers` varchar(45) not null
    ,`customer_discount` double not null
    ,primary key(id)
);

-- СТРАХОВЫЕ_АГЕНТЫ
create table if not exists `Insurance_Agents`(
	`id` int(11) not null auto_increment
    ,`surname_agent` varchar(45) not null
    ,`name_agent` varchar(45) not null
    ,`patronymic_agent` varchar(45) not null
    ,`passport_agent` varchar(45) not null
    ,`agent_percent` double not null
    ,primary key(id)
);

-- Вид страхования 
create table if not exists `Insurance_type`(
	`id` int(11) not null auto_increment
    ,`insurance_type` varchar(45) not null
    ,`rate` int not null
    ,primary key(id)
);

-- ДОГОВОРЫ
create table if not exists `Contracts`(
	`id` int(11) not null auto_increment
    ,`id_customers` int not null
    ,`id_agent` int not null
    ,`id_insurance_type` int not null
    ,`insurance_amount` double not null
    ,`date` date not null
    ,primary key(id)
    ,foreign key(id_customers) references Customers(id)
    ,foreign key(id_agent) references Insurance_Agents(id)
    ,foreign key(id_insurance_type) references Insurance_type(id)
);


