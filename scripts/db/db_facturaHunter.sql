-- SQ}Book: CODE
CREATE DATABASE JosCaVi;
DROP DATABASE JosCaVi;'borrar base de datos';
USE JosCaVi;
CREATE TABLE tb_personas(
    cc INT(11) NOT NULL, 
    nom_com VARCHAR(57)  DEFAULT 'No hay nombre', 
    edad INTEGER(3) NOT NULL,
    PRIMARY KEY (cc)
);
DROP TABLE tb_personas; 'eliminamos tabla con estee comando';
ALTER TABLE tb_personas MODIFY COLUMN nom_com VARCHAR(60);'modificamos tb';
CREATE DATABASE db_hunter_facture_josCabrejo;
DROP DATABASE db_hunters_facture_joscavi;
USE db_hunter_facture_josCabrejo;
CREATE TABLE tb_bill(
    n_bill VARCHAR(25) NOT NULL PRIMARY KEY COMMENT 'número de la factura unico con las convinaciones necesarias',
    bill_date DATETIME NOT NULL  DEFAULT NOW() UNIQUE COMMENT 'fecha cunado se genero la factura, ademas es unica'
);
/*
?Insertamos las llaves foraneas 
*/
ALTER TABLE tb_bill MODIFY identificacion_fk INT(25) NOT NULL COMMENT 'Relacion de la tabla tb_client';
ALTER TABLE tb_bill ADD id_seller_fk INT(11) NOT NULL COMMENT 'Relacion de la tabla tb_seller';
ALTER TABLE tb_bill ADD id_product_fk INT(25) NOT NULL COMMENT 'Relacion de la tabla tb_product';

/*
?Creamos los campos de las llaves foraneas 
*/
ALTER TABLE tb_bill ADD CONSTRAINT tb_bill_tb_client_fk FOREIGN KEY(identificacion_fk) REFERENCES tb_client(identificacion);
ALTER TABLE tb_bill ADD CONSTRAINT tb_bill_tb_seller_fk FOREIGN KEY(id_seller_fk) REFERENCES tb_seller(id_seller);
ALTER TABLE tb_bill ADD CONSTRAINT tb_bill_tb_product_fk FOREIGN KEY(id_product_fk) REFERENCES tb_product(id_product);
CREATE TABLE tb_client(
    identificacion INT(25) NOT NULL PRIMARY KEY COMMENT 'número de identificacion unico cliente',
    full_name VARCHAR (50) NOT NULL  COMMENT 'nombre completo de cliente ',
    email VARCHAR(50) NOT NULL COMMENT 'email del cliente',
    address VARCHAR (70) NOT NULL COMMENT 'direccion del cliente',
    phone VARCHAR (11) NOT NULL COMMENT 'telefono del cliente'  
);
CREATE TABLE tb_product(
    id_product INT(25) NOT NULL PRIMARY KEY COMMENT 'número del producto unico',
    name_product VARCHAR(15) NOT NULL  COMMENT 'nombre del producto',
    amount INT(3) NOT NULL COMMENT 'cantidad de productos',
    value_prodcut FLOAT(6) NOT NULL COMMENT 'valor del producto'
);
CREATE TABLE tb_seller(
    id_seller INT(25) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'identificacion del vendedor autoincremental',
    seller VARCHAR(50) NOT NULL COMMENT 'nombre del vendedor'
);
ALTER TABLE tb_product MODIFY COLUMN id_product INT(25);
INSERT INTO tb_bill (n_bill) VALUES ("21212") COMMENT 'insetar un dato';
SELECT* FROM tb_bill;