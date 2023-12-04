-- create a database named BTL_CNPM
CREATE DATABASE cnpm;

-- create a table users
CREATE TABLE users (
    user_id INT NOT NULL AUTO_INCREMENT,
    user_name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    user_realname VARCHAR(255) NOT NULL,
    user_print_history LONGTEXT,
    user_page_left INT NOT NULL,
    user_purchase_history LONGTEXT,
    PRIMARY KEY (user_id)
);

-- create a table printers with printer_ID, printer_name, printer_status
CREATE TABLE printers (
    printer_ID INT NOT NULL AUTO_INCREMENT,
    printer_name VARCHAR(255) NOT NULL,
    printer_status VARCHAR(255) NOT NULL,
    PRIMARY KEY (printer_ID)
);

-- add data to users table
INSERT INTO users (username, password, user_realname, user_print_history, user_page_left, user_purchase_history) VALUES ('duong.cao03', '21022003', 'Cao Đức Dương', '', 20, '');
INSERT INTO users (username, password, user_realname, user_print_history, user_page_left, user_purchase_history) VALUES ('hien.lequang47', '15102003', 'Lê Quang Hiển', '', 20, '');
INSERT INTO users (username, password, user_realname, user_print_history, user_page_left, user_purchase_history) VALUES ('khang.nguyenLVC', '26012003', 'Nguyễn Văn Hoàng Khang', '', 20, '');

-- add data to printers table
INSERT INTO printers (printer_name, printer_status) VALUES ('H1_1', 'OK');
INSERT INTO printers (printer_name, printer_status) VALUES ('H1_2', 'OK');
INSERT INTO printers (printer_name, printer_status) VALUES ('H3_1', 'OK');
INSERT INTO printers (printer_name, printer_status) VALUES ('H3_4', 'FAILED');
INSERT INTO printers (printer_name, printer_status) VALUES ('H6_1', 'OK');
INSERT INTO printers (printer_name, printer_status) VALUES ('H6_6', 'BUSY');

