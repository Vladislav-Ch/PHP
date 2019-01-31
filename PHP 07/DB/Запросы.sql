-- Выбирает из таблицы КЛИЕНТЫ информацию о клиентах с фамилией «Иванов», 
-- серия-номер паспорта которых начинается с цифр «34»
select
	id as '№'
     ,concat(surname_customers, ' ', substring(name_customers,1,1), '.', substring(patronymic_customers,1,1), '.') as 'Фамилия И.О.'
     ,passport_ciustomers as 'Паспорт'
     ,customer_discount as 'Скидка'
from
	`my_db`.`customers`
where
	surname_customers like 'Русин'
    and passport_ciustomers like '__ 89%';
    
-- Запрос на выборку	Выбирает из таблицы АГЕНТЫ информацию о страховых агентах, 
-- процент вознаграждения для которых находится в диапазоне от 20% до 50 %
select
	id as '№'
     ,concat(surname_agent, ' ', substring(name_agent,1,1), '.', substring(patronymic_agent,1,1), '.') as 'Фамилия И.О.'
     ,agent_percent as 'Процент'
from
	`my_db`.`insurance_agents`
where
	agent_percent between 20 and 30;
    
-- Запрос на выборку	Выбирает из таблиц АГЕНТЫ и ДОГОВОРЫ информацию о страховых агентах и договорах, 
-- для которых значение в поле Сумма страхования не меньше 200 000 руб.
select
	contracts.id as '№'
     ,concat(insurance_agents.surname_agent, ' ', substring(insurance_agents.name_agent,1,1), '.', substring(insurance_agents.patronymic_agent,1,1), '.') as 'Фамилия И.О.'
     ,insurance_amount as 'Сумма страхования'
from
	contracts join insurance_agents on contracts.id_agent = insurance_agents.id
where
	contracts.insurance_amount > 200000;
    
-- Запрос с параметром	Выбирает из таблицы АГЕНТЫ информацию о страховых агентах с заданной фамилией. 
select
	id as '№'
     ,concat(surname_agent, ' ', substring(name_agent,1,1), '.', substring(patronymic_agent,1,1), '.') as 'Фамилия И.О.'
     ,agent_percent as 'Процент'
from
	`my_db`.`insurance_agents`
where
	surname_agent like 'Зайцева';
    
-- Запрос с параметром	Выбирает из таблиц КЛИЕНТЫ, ДОГОВОРЫ и АГЕНТЫ информацию обо всех договорах 
-- (ФИО клиента, Вид страхования, Сумма страхования, Дата заключения договора, ФИО агента), заключенных в некоторый заданный период времени. 
select
	contracts.id as '№'
     ,concat(customers.surname_customers, ' ', substring(customers.name_customers,1,1), '.', substring(customers.patronymic_customers,1,1), '.') as 'Фамилия И.О. Клиента'
     ,concat(insurance_agents.surname_agent, ' ', substring(insurance_agents.name_agent,1,1), '.', substring(insurance_agents.patronymic_agent,1,1), '.') as 'Фамилия И.О. Агента'
     ,insurance_type.insurance_type as 'Вид страхования'
     ,insurance_amount as 'Сумма страхования'
     ,contracts.date as 'Дата'
from
	contracts join insurance_agents on contracts.id_agent = insurance_agents.id
    join insurance_type on contracts.id_insurance_type = insurance_type.id
    join customers on contracts.id_customers = customers.id
where
	contracts.date between '2018-12-01' and '2018-12-31';
    
-- Вычисляет для каждого договора размер страховой премии. 
-- Включает поля Дата заключения договора, Фамилия клиента, Имя клиента, Отчество клиента, Сумма страхования, Страховая премия. 
-- Сортировка по полю Дата заключения договора
select
	contracts.id as '№'
	,contracts.date as 'Дата'
	,customers.surname_customers as 'Фамилия клиента'
    ,customers.name_customers as 'Имя клиента'
    ,customers.patronymic_customers as 'Отчество клиента'
    ,contracts.insurance_amount as 'Сумма страхования'
    ,contracts.insurance_amount * (insurance_type.rate - customers.customer_discount) as 'Страховая премия'
from
	contracts join customers on contracts.id_customers = customers.id
			  join insurance_type on contracts.id_insurance_type = insurance_type.id
order by contracts.date;

-- Выполняет группировку по полю Дата заключения договора. 
-- Для каждой группы вычисляет минимальное и максимальное значения по полю Сумма страхования
select
	contracts.id as '№'
    ,contracts.date as 'Дата'
    ,max(contracts.insurance_amount) as 'Максимальная Сумма страхования'
    ,min(contracts.insurance_amount) as 'Минимальная Сумма страхования'
from
	contracts
group by contracts.date;

-- удалить таблицу Вип клиенты
drop table `vip_customer`;

-- Создает таблицу VIP_КЛИЕНТЫ, содержащую информацию о клиентах, для которых процент скидки равен 0.5%
create table if not exists `vip_customer`
select 
	*
from
	customers
where
	customers.customer_discount like 0.5;

-- удалить таблицу КОПИЯ_АГЕНТЫ
drop table `copy_insurance_agents`;

-- Создает копию таблицы АГЕНТЫ с именем КОПИЯ_АГЕНТЫ
create table if not exists `copy_insurance_agents`
select 
	*
from
	insurance_agents;

-- Удаляет из таблицы КОПИЯ_АГЕНТЫ записи, в которых значение в поле Процент вознаграждения больше 30%
delete 
from 
	copy_insurance_agents
where
	copy_insurance_agents.agent_percent > 30;
    
-- Устанавливает значение в поле Процент вознаграждения таблицы КОПИЯ_АГЕНТЫ равным 20% для агентов, 
-- имеющих процент вознаграждения от 15 до 19 процентов
update 
	copy_insurance_agents
set
	copy_insurance_agents.agent_percent = 20
where 
	copy_insurance_agents.agent_percent between 15 and 19;

    
