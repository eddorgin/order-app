--#1
select client_id, count(*)
from order_db.my_order
where price < 1000
group by client_id
having count(*) > 1000;

--#2
select id, price, clientId, created_at
from (SELECT
    @row_number:=CASE
        WHEN @number = client_id THEN @row_number + 1
        ELSE 1
    END AS num,
    @number:=client_id as clientId,
    id,
    price,
    created_at
FROM
    order_db.my_order
ORDER BY clientId, created_at DESC) as derrived
where num <= 3;

--#3
select id, price, clientId
from (SELECT
    @row_number:=CASE
        WHEN @number = client_id THEN @row_number + 1
        ELSE 1
    END AS num,
    @number:=client_id as clientId,
    id,
    price
FROM
    order_db.my_order
where price > 1000
ORDER BY clientId, created_at DESC) as derrived
where num <= 3;

--#4
select phone
from order_db.my_order
order by `name`;