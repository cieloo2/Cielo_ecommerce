CREATE TABLE PRODUCTO(
    codpro int not null AUTO_INCREMENT,
    nompro varchar(50) null,
    despro varchar(256) null,
    prepro numeric(6,2) null,
    estado int null,
    CONSTRAINT pk_producto
    PRIMARY KEY (codpro)
);

alter TABLE PRODUCTO add rutimapro varchar(100) null;

INSERT INTO PRODUCTO(nompro,despro,prepro,estado,rutimapro)
VALUES ('Producto 2', 'Descripcion 2', '2000.00', 1,'prod2.png');

CREATE TABLE ORDERS(
id int AUTO_INCREMENT not null,
customer_name varchar(80) not null,
customer_email varchar(120) not null,
customer_mobile varchar(40) not null,
transactional_status varchar(20) not null,
created_at datetime not null,
updated_at datetime not null,

PRIMARY KEY (id)
);

alter TABLE ORDERS add   codpro int not null ,
alter TABLE ORDERS  add  nompro varchar(50) null,
alter TABLE ORDERS  add  despro varchar(256) null,
alter TABLE ORDERS  add  prepro numeric(6,2) null,
alter TABLE ORDERS  add  estado int null,