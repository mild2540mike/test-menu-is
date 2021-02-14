CREATE TABLE IF NOT EXISTS menu (
    menu_ID varchar(5) NOT NULL ,
    menu_Name varchar(50) NOT NULL,
    menu_Type int(2) NOT NULL,
    menu_price int(4) ,
    PRIMARY KEY (menu_ID)
)ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

