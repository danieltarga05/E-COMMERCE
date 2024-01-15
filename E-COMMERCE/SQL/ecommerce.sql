create database if not exists ecommerce;
create table if not exists ecommerce.users
(
    id int not null auto_increment primary key,
    email varchar(50),
    password varchar(256),
    cart_id int,
    role_id int
);

create table if not exists ecommerce.roles
(
    id int not null auto_increment primary key,
    nome varchar(50),
    descrizione varchar(50)
);

create table if not exists ecommerce.sessions
(
    id int not null auto_increment primary key,
    ip varchar(16),
    data_login datetime,
    user_id int
);

create table if not exists ecommerce.carts
(
    id int not null auto_increment primary key
);

create table if not exists ecommerce.cart_products
(
    cart_id int,
    product_id int,
    quantita int
);

create table if not exists ecommerce.products
(
    id int not null auto_increment primary key,
    nome varchar(50),
    prezzo float,
    marca varchar(50)
);

alter table ecommerce.users
add foreign key (cart_id) references carts(id),
add foreign key (role_id) references roles(id);

alter table ecommerce.cart_products
add foreign key (cart_id) references carts(id),
add foreign key (product_id) references products(id);

alter table ecommerce.sessions
add foreign key (user_id) references users(id);
