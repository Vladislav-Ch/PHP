use car_rental;

DELIMITER //

-- Выбирает из таблицы АВТОМОБИЛИ информацию об автомобилях заданной модели

create procedure Proc_01 (in model nvarchar(45))
begin
	select
		car.id
        ,model_car.model
        ,color.color
        ,year
        ,gos_nomer
        ,insurance_value
        ,cost_one_day
	from
		car join model_car on car.id_model_car = model_car.id
			join color on car.id_color = color.id
	where 
		model_car.model like model;
end//

call Proc_01 ('Toyota Camry')//


-- Выбирает из таблицы АВТОМОБИЛИ информацию об автомобилях, изготовленных до заданного года
create procedure Proc_02 (in year int)
begin
	select
		car.id
        ,model_car.model
        ,color.color
        ,year
        ,gos_nomer
        ,insurance_value
        ,cost_one_day
	from
		car join model_car on car.id_model_car = model_car.id
			join color on car.id_color = color.id
	where 
		car.year < year;
end//

call Proc_02 (2010)//

-- Выбирает из таблицы АВТОМОБИЛИ информацию об автомобилях, имеющих заданные модель и цвет, изготовленных после заданного года 
create procedure Proc_03 (in model nvarchar(45), in color nvarchar(45), in year int)
begin
	select
		car.id
        ,model_car.model
        ,color.color
        ,year
        ,gos_nomer
        ,insurance_value
        ,cost_one_day
	from
		car join model_car on car.id_model_car = model_car.id
			join color on car.id_color = color.id
	where 
		car.year > year and
        model_car.model like model and
        color.color like color;
end//

call Proc_03 ('Renault Logan', 'Белый', 2005)//

-- Выбирает из таблицы АВТОМОБИЛИ информацию об автомобиле с заданным госномером.
 create procedure Proc_04 (in nomer nvarchar(45))
begin
	select
		car.id
        ,model_car.model
        ,color.color
        ,year
        ,gos_nomer
        ,insurance_value
        ,cost_one_day
	from
		car join model_car on car.id_model_car = model_car.id
			join color on car.id_color = color.id
	where 
		car.gos_nomer like nomer;
end//

call Proc_04 ('АН 4567 АП')//

-- Выбирает из таблиц КЛИЕНТЫ, АВТОМОБИЛИ и ПРОКАТ информацию обо всех зафиксированных фактах проката автомобилей 
-- (ФИО клиента, Модель автомобиля, Госномер автомобиля, дата проката) в некоторый заданный интервал времени. 
create procedure Proc_05 (in date_one date, in date_two date)
begin
	select
		rental.id
		,concat(clients.surname, ' ', substring(clients.name,1,1), '.', substring(clients.patronymic,1,1), '.') as client
		,model_car.model
		,car.gos_nomer
		,rental.start_dat
	from
		rental join car on rental.id_car = car.id
                join model_car on car.id_model_car = model_car.id
				join clients on rental.id_client = clients.id
	where
		rental.start_dat between date_one and date_two;
end//

call Proc_05 ('2018-11-15', '2018-12-15')//

-- Вычисляет для каждого факта проката стоимость проката. 
-- Включает поля Дата проката, Госномер автомобиля, Модель автомобиля, Стоимость проката. 
-- Сортировка по полю Дата проката
create procedure Proc_06 ()
begin
	select 
		rental.id
        ,rental.start_dat
        ,car.gos_nomer
        ,model_car.model
        ,car.cost_one_day * rental.count_day as count_procat
	from
		rental join car on rental.id_car = car.id 
			   join model_car on car.id_model_car = model_car.id
	order by rental.start_dat;
		
end//

call Proc_06 ()//	

-- Выполняет группировку по полю Год выпуска автомобиля.
-- Для каждого года вычисляет минимальное и максимальное значения по полю Стоимость одного дня проката
create procedure Proc_08()
begin
	select
		car.id
        ,model_car.model
        ,year
        ,min(cost_one_day) as min_cost
        ,max(cost_one_day) as max_cost
	from
		car join model_car on car.id_model_car = model_car.id
			join color on car.id_color = color.id
	group by
		car.year;
end//

call Proc_08()//

-- Создает таблицу СТАРЫЕ_АВТОМОБИЛИ, содержащую информацию об автомобилях с годом выпуска по заданный год включительно
create procedure Proc_09(in year int)
begin
	create table old_cars
    select 
		*
	from
		car
	where
		car.year < year;
end//
	
call Proc_09(2014)//

-- Создает копию таблицы АВТОМОБИЛИ с именем КОПИЯ_АВТОМОБИЛИ
create procedure Proc_10()
begin
	create table copy_car like car;
    insert copy_car 
    select
		*
	from
		car;
end//

call Proc_10()//

-- Удаляет из таблицы КОПИЯ_АВТОМОБИЛИ записи, в которых значение в поле Стоимость одного дня проката больше заданного
create procedure Proc_11(in cost int)
begin
	delete
		from
			copy_car
		where
			copy_car.cost_one_day > cost;
end//

call Proc_11(5500)//

-- Увеличивает значение в поле Стоимость одного дня проката таблицы КОПИЯ_АВТОМОБИЛИ 
-- на заданное количество процентов для автомобилей, изготовленных после заданного года
create procedure Proc_12(in procent int, in year int)
begin
	update
		copy_car
	set
		copy_car.cost_one_day = copy_car.cost_one_day + (( copy_car.cost_one_day * procent) / 100)
	where
		copy_car.year > year;
end//

call Proc_12(5, 2005)//
			




		