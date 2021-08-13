create database db_restoran;

use db_restoran;

create table t_level (
    id_level int primary key auto_increment,
    nama_level varchar(12)
);

insert into t_level values
    (null,'Pelanggan'),
    (null,'Member'),
    (null,'Waiter'),
    (null,'Kasir'),
    (null,'Admin'),
    (null,'Owner');

create table t_user (
    id_user int primary key auto_increment,
    username varchar(30),
    password varchar(30),
    nama_user text,
    id_level int(11)
);

alter table t_user add constraint berlevel foreign key (id_level)
references t_level(id_level) on delete restrict on update restrict;

insert into t_user values
    (null,'admin','admin','admin','5'),
    (null,'Owner','Owner','Owner','6'),
    (null,'Waiter','Waiter','Waiter','3'),
    (null,'Kasir','Kasir','Kasir','4');

create table t_menu(
    id_menu int primary key auto_increment,
    jenis_menu varchar(20),
    nama_menu text,
    harga varchar(20),
    status_menu text,
    thumb varchar(255)
);

create table t_order(
    id_order int primary key auto_increment,
    no_meja varchar(2),
    tanggal varchar(20),
    id_user int(11),
    keterangan text
);

alter table t_order add constraint diorder_oleh foreign key(id_user)
references t_user(id_user) on delete cascade on update cascade;

create table t_detail_order(
    id_detail_order int primary key auto_increment,
    id_order int(11),
    id_menu int(11),
    jumlah varchar(2),
    status text
);

alter table t_detail_order add constraint detail_untuk foreign key(id_order)
references t_order(id_order) on delete cascade on update cascade;

alter table t_detail_order add constraint nama_menu foreign key(id_menu)
references t_menu(id_menu) on delete cascade on update cascade;

create table t_transaksi(
    id_transaksi int primary key auto_increment,
    id_user int(11),
    id_order int(11),
    tanggal varchar(20),
    total_bayar varchar(20)
);

alter table t_transaksi add constraint pesanan foreign key(id_transaksi)
references t_order(id_order) on delete restrict on update restrict;

alter table t_transaksi add constraint atas_nama foreign key(id_user)
references t_user(id_user) on delete restrict on update restrict;