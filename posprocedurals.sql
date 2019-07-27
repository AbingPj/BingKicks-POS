DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addSales`(IN `sales` DOUBLE, IN `admin` INT)
    NO SQL
BEGIN

DECLARE adminid INT(11) DEFAULT 0;
DECLARE tsales  DOUBLE DEFAULT 0.0;
DECLARE cdate  VARCHAR(50);

SET adminid = admin;
SET tsales = sales;
SET cdate = "";


SELECT CURDATE() INTO cdate;
INSERT INTO sales(TotalSales, dateAndtime, admin) VALUES ( tsales, cdate, adminid);
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateToOrderKart`(IN `nid` INT, IN `nqt` INT)
    NO SQL
BEGIN

DECLARE pID INT(11) DEFAULT 0;
DECLARE pPrice  DOUBLE DEFAULT 0.0;
DECLARE ntotal  DOUBLE DEFAULT 0.0;
DECLARE qt  INT(11) DEFAULT 0;

SET pID = nid;
SET pPrice = 0.0;
SET ntotal = 0.0;
SET qt = nqt;


SELECT price INTO pPrice FROM product WHERE id = pID;
SET ntotal = qt * pPRice;

IF (pID > 0) THEN
UPDATE orderkart SET quantity = qt, total = ntotal WHERE id = pID;
end if;

END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addToOrderKart2`(IN `nid` INT)
    NO SQL
BEGIN
DECLARE pID INT(11) DEFAULT 0;
DECLARE pPrice  DOUBLE DEFAULT 0.0;
DECLARE pPrice2  DOUBLE DEFAULT 0.0;
DECLARE qt  INT(11) DEFAULT 0;
DECLARE qt2  INT(11) DEFAULT 0;
DECLARE countProduct  INT(11) DEFAULT 0;

SET pID = nid;
SET pPrice = 0.0;
SET pPrice2 = 0.0;
SET qt = 1;
SET qt2 = 0;
SET countProduct = 0;

SELECT price INTO pPrice FROM product WHERE id = pID;
SELECT COUNT(*) INTO countProduct FROM orderkart WHERE id = pID;
SELECT quantity INTO qt2 FROM orderkart WHERE id = pID;
SET qt2 = qt2 + qt;
SET pPrice2 = pPrice * qt2;

IF (countProduct = 0) THEN
INSERT INTO orderkart(id, quantity, total) VALUES( pID, qt, pPRice);
elseif (countProduct > 0) then
UPDATE orderkart SET quantity = qt2, total = pPRice2 WHERE id = pID;
end if;


END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addToOrderKart`(IN `nid` INT)
    NO SQL
BEGIN
DECLARE pID INT(11) DEFAULT 0;
DECLARE pPrice  DOUBLE DEFAULT 0.0;
DECLARE pPrice2  DOUBLE DEFAULT 0.0;
DECLARE qt  INT(11) DEFAULT 0;
DECLARE qt2  INT(11) DEFAULT 0;
DECLARE countProduct  INT(11) DEFAULT 0;

SET pID = nid;
SET pPrice = 0.0;
SET pPrice2 = 0.0;
SET qt = 1;
SET qt2 = 0;
SET countProduct = 0;

SELECT price INTO pPrice FROM product WHERE id = pID;
SELECT COUNT(*) INTO countProduct FROM orderkart WHERE id = pID;
SELECT quantity INTO qt2 FROM orderkart WHERE id = pID;
SET qt2 = qt2 + qt;
SET pPrice2 = pPrice * qt2;

IF (countProduct = 0) THEN
INSERT INTO orderkart(id, quantity, total) VALUES( pID, qt, pPRice);
elseif (countProduct > 0) then
UPDATE orderkart SET quantity = qt2, total = pPRice2 WHERE id = pID;
end if;


END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addtoProductSold`()
    NO SQL
BEGIN

    DECLARE sID  INT(11) DEFAULT 0;
    DECLARE countProducts  INT(11) DEFAULT 0;
    DECLARE i  INT;
DECLARE pID INT(11) DEFAULT 0;
DECLARE qt INT(11) DEFAULT 0;
DECLARE totals DOUBLE DEFAULT 0.0;
DECLARE j int DEFAULT 0;

    SET sID = 0;
    SET i = 0;
SET j = 0;
    SET countProducts = 0;
SET pID = 0;
SET qt = 0;
SET totals = 0;

    SELECT COUNT(*) INTO countProducts FROM orderkart;
    SELECT id INTO sID FROM sales ORDER BY id DESC LIMIT 1;

WHILE i < CountProducts DO

SELECT oid INTO j FROM orderkart ORDER BY oid LIMIT i,1;

SELECT id INTO pID FROM orderkart WHERE oid = j;
SELECT quantity INTO qt FROM orderkart WHERE oid = j;
SELECT total INTO totals FROM orderkart WHERE oid = j; 
INSERT INTO product_sold(product, sales_number, quantity, total) VALUES(pID, sID, qt, totals);

SET i = i + 1;
END WHILE;

END$$
DELIMITER ;