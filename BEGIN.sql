/* kulang ug minus sa total stock sa addingDritemsClient ug plus stock sa addingClientReturnItems didto sa tbl_itemtotal*/
CREATE procedure addingDritemsClient(
IN drID INTEGER,
IN pID INTEGER,
IN pQty INTEGER
)
BEGIN
DECLARE poID INTEGER;
DECLARE pQty INTEGER;
DECLARE itemExist INTEGER;
DECLARE prodPrice FLOAT;
DECLAE drAmount FLOAT;
DECLARE prevDrAmnt FLOAT;
DECLARE stock INTEGER;
DECLARE stockLeft INTEGER;

SELECT clientdr_poid INTO poiD FROM cash_clientdr WHERE client_drid = drID;
SELECT corder_totalqty INTO pQty FROM cash_clientpoitems WHERE corder_product = pID AND corder_id = poID;
SELECT COUNT(corder_product) INTO itemExist FROM cash_clientpoitems WHERE corder_id = poID AND corder_product = pID;
SELECT prod_price INTO prodPrice FROM tbl_product WHERE prod_id = pID AND prod_active = 1;
SELECT clientdr_amount INTO prevDrAmnt FROM cash_clientdr WHERE clientdr_drid = drID;
SELECT total_qty INTO stock FROM tbl_itemtotal WHERE total_product = pID;

SET drAmount = prodPrice * pQty;
SET stockLeft = stock - pQty;

IF itemExist != 0 && stock >= pQty THEN
INSERT INTO cash_clientdritems (cdritems_drid,cdritems_product,cdritems_qty,cdritems_amount) VALUES (drID,pID,pQty,drAmount);
UPDATE cash_clientdr SET clientdr_amount = drAmount WHERE clientdr_drid = drID;
UPDATE tbl_itemtotal SET total_qty = stockLeft WHERE total_product = pID;

END IF;
END

CREATE procedure addingClientReturnItems(
IN drID INTEGER,
IN pID INTEGER,
IN pQty INTEGER
)
BEGIN
DECLARE itemExist INTEGER; DECLARE itemDiff INTEGER; DECLARE dritemsQty INTEGER;
DECLARE poItemQty INTEGER; DECLARE poID INTEGER; DECLARE returnExist INTEGER;
DECLARE dmgExist INTEGER; DECLARE stock INTEGER; DECLARE stockLeft INTEGER;

SELECT clientdr_poid INTO poID FROM cash_clientdr FROM clientdr_drid = drID;

SELECT COUNT(cdritems_product) INTO itemExist FROM cash_clientdritems WHERE cdritems_drid = drID AND cdritems_product = pID;
SELECT cdritems_qty INTO dritemsQty FROM cash_clientdritems WHERE cdritems_drid = drID AND cdritems_product = pID;
SELECT corder_totalqty INTO poItemQty FROM cash_clientdritems WHERE corder_id = poID AND corder_product = pID;
SELECT COUNT(return_product) INTO returnExist FROM cash_drreturn WHERE return_drid = drID AND return_product = pID;
SELECT COUNT(dmg_product) INTO dmgExist FROM cash_dmgitems WHERE dmg_drid = drID;
SELECT total_qty INTO stock FROm tbl_itemtotal WHERE total_product = pID;

SET stockLeft = stock - pQty;
SET itemDiff = dritemsQty - poItemQty; 


IF itemExist != 0 && itemDiff < 0 && returnExist = 0 && dmgExist = 0 THEN
   INSERT INTO cash_drreturn (return_drid,return_product,return_qty) VALUES (drID,pID,pQty);  
   UPDATE tbl_itemtotal SET total_qty = stockLeft WHERE total_product = pID;
END IF;
END

CREATE procedure addingDmgItems(
IN drID INTEGER,
IN pID INTEGER,
IN pQty INTEGER
)
BEGIN
DECLARE poID INTEGER; DECLARE dmgExist INTEGER;
DECLARE itemExist INTEGER; DECLARE itemDiff INTEGER;
DECLARE returnExist INTEGER; DECLARE dritemsQty INTEGER;
DECLARE poItemQty INTEGER;

SELECT clientdr_poid INTO poID FROM cash_clientdr WHERE clientdr_drid = drID;
SELECT COUNT(cdritems_product) INTO itemExist FROM cash_clientdritems WHERE cdritems_drid = drID AND cdritems_product = pID;
SELECT COUNT(return_product) INTO returnExist  FROM cash_drreturn WHERE return_drid = drID AND return_product = pID;
SELECT COUNT(dmg_product) INTO dmgExist FROM cash_dmgitems WHERE dmg_drid = drID;
SELECT cdritems_qty INTO dritemsQty FROM cash_clientdritems WHERE cdritems_drid = drID AND cdritems_product = pID;
SELECT corder_totalqty INTO poItemQty FROM cash_clientdritems WHERE corder_id = poID AND corder_product = pID;

SET itemDiff = dritemsQty - poItemQty;

IF itemExist != 0 && returnExist = 0 && dmgExist = 0 && itemDiff < 0 THEN
  INSERT INTO cash_dmgitems(dmg_drid,dmg_product,dmg_qty) VALUES (drID,pID,pQty)

END IF;


END
CREATE procedure Client_Payment(
IN drID INTEGER,
IN Payment FLOAT
)
BEGIN
DECLARE drTotal FLOAT;
DECLARE balanceNew FLOAT;
DECLARE balanceOld FLAOT;
DECLARE clientExist INTEGER;
DECLARE clientID INTEGEr;
DECLARE clientBalance FLOAT;

SELECT c.clientpo_customer INTO clientID FROM cash_clientpo c INNER JOIN client_dr d 
ON d.clientdr_poid = c.clientpo_poid AND d.clientdr_drid = drID;


SELECT clientdr_amount INTO drTotal FROM cash_clientdr WHERE clientdr_drid = drID;
SELECT COUNT(cb_client) INTO clientExist FROM cash_clientbalance WHERE cb_client = clientID;  
SELECT cb_balance INTO clientBalance FROM cash_clientbalance WHERE cb_client = clientID;

SET balanceNew = drTotal - Payment;
SET balaceOld = clientBalance - Payment;

INSERT INTO cash_clientpayment (payment_drid,payment_amount) VALUES (drID,Payment);

IF clientExist = 0 THEN
  INSERT INTO cash_clientbalance (cb_client,cb_balance) VALUES (clientID, balanceNew);

ELSE
  UPDATE cash_clientbalance SET cb_balance = balanceOld WHERE cb_client = clientID;
   
END IF;
END
/* at the top procedure is published */


CREATE procedure WalkIN_OrderItems(
IN orderID INTEGER,
IN pID INTEGER,
IN pQty INTEGER
)
BEGIN
DECLARE stock INTEGER;
DECLARE prevtotalStock INTEGER; DECLARE prevQty INTEGER;
DECLARE newTotalStock INTEGER; DECLARE prevAmnt FLOAT; DECLARE newAmnt FLOAT;
DECLARE prodPrice FLOAT; DECLARE prodExist INTEGER;
DECLARE orderItemsTotal FLOAT; 

DECLARE prevOrderAmnt FLOAT; DECLARE newOrderAmnt FLOAT;
DECLARE prevOrderQty INTEGER; DECLARE newOrderQty INTEGER;

SELECT total_qty INTO stock FROM tbl_itemtotal WHERE total_product = pID;
SELECT worder_totalqty INTO prevtotalStock FROm cash_walkorder WHERE worder_id = orderID;
SELECT prod_retprice INTO prodPrice FROM tbl_product WHERE prod_id = pID AND prod_active = 1;
SELECT COUNT(woritems_product) INTO prodExist FROM cash_walkorderitems WHERE woitems_orderid = orderID AND woritems_product = pID; 
SELECT worder_amount INTO prevAmnt FROM cash_walkoder WHERE worder_id = orderID;
SELECT woitems_total INTO prevOrderAmnt FROM cash_walkoderitems WHERE woitems_product = pID AND woitems_orderid = orderID;
SELECT woitems_qty INTO prevOrderQty FROM cash_walkorderitems WHERE woitems_product = pID AND woitems_orderid = orderID;


SET newTotalStock = prevtotalStock + pQty;	
SET orderItemsTotal = prodPrice * pQty;	
SET newAmnt = orderItemsTotal + prevAmnt;
SET newOrderAmnt = prevOrderAmnt + orderItemsTotal;
SET newOrderQty = prevOrderQty + pQty;

IF stock >= pQty THEN
  IF prodExist = 0 THEN
     INSERT INTO cash_walkorderitems(woitems_orderid,woritems_product,woitems_qty,woitems_total) VALUES (orderID,pID,pQty,orderItemsTotal);
     UPDATE cash_walkorder SET worder_totalqty = newTotalStock , worder_amount = newAmnt WHERE worder_id = orderID; 
   
   ELSE
   
     UPDATE cash_walkorderitem SET woitems_qty = newOrderQty , woitems_total = newOrderAmnt WHERE worder_id = orderID;
     UPDATE cash_walkorder SET worder_totalqty = newTotalStock , worder_amount = newAmnt WHERE worder_id = orderID; 
  END IF;
END iF;
END


CREATE procedure addingDritemsToWalk(
IN drID INTEGER,
IN pID INTEGER,
IN pQty INTEGER
)
BEGIN
DECLARE prodExist INTEGER;     DECLARE prevDrAmnt FLOAT;  DECLARE newDrAmnt FLOAT;
DECLARE prodPrice FLOAT;       DECLARE prevDrQty INTEGER; DECLARE newDrQty INTEGER;
DECLARE prodTotalPrice FLOAT;
DECLARE poStock INTEGER;       DECLARE prevItemQty INTEGER; DECLARE newItemQty INTEGER;
DECLARE itemStock INTEGER;     DECLARE prevItemAmnt FLOAT;  DECLARE newItemAmnt FLOAT;
DECLARE stockLeft INTEGER;

SELECT COUNT(wdritems_product) INTO prodExist FROM cash_waldritems WHERE wdritems_product = pID AND wdritems_drid = drID;
SELECT prod_retprice INTO prodPrice FROM tbl_product WHERE prod_id = pID AND prod_active = 1; 
SELECT o.woitems_qty INTO poStock FROM cash_walkorderitems o INNER JOIN cash_walkdr d 
ON d.walkdr_poid = o.woitems_orderid AND d.walkdr_drid = drID;

SELECT 	walkdr_totalqty  INTO prevDrQty FROM cash_walkdr WHERE walkdr_drid = drID;
SELECT walkdr_amount INTO prevDrAmnt FROM cash_walkdr WHERE walkdr_drid  = drID;
SELECT total_qty INTO itemStock FROM tbl_itemtotal WHERE total_product = pID;
SELECT wdritems_qty INTO prevItemQty FROM cash_walkdritems WHERE wdritems_product = pID AND wdritems_drid = drID;
SELECT wdritems_amount INTO prevItemAmnt FROM cash_walkdritems WHERE wdritems_product = pID AND wdritems_drid = drID; 	

SET prodTotalPrice = prodPrice * pQty;
SET newDrQty = prevDrQty + pQty;
SET newDrAmnt = prevAmnt + prodTotalPrice;
SET newItemQty = prevItemQty + pQty;
SET newItemAmnt = prevItemAmnt + prodTotalPrice;
SET stockLeft  = itemStock - pQty;

IF prodExist = 0 && poStock >= pQty  && itemStock >= pQty THEN
   INSERT INTO cash_walkdritems (wdritems_drid,wdritems_product,wdritems_qty,wdritems_amount) VALUES (drID,pID,pQty,prodTotalPrice);
   UPDATE cash_walkdr SET walkdr_amount = newDrAmnt , walkdr_totalqty = newDrQty WHERE walkdr_drid = drID; 
   UPDATE tbl_itemtotal SET total_qty = stockLeft WHERE total_product = pID;
ELSE 
   UPDATE cash_walkdritems SET wdritems_qty = newItemQty , wdritems_amount = newItemAmnt WHERE wdritems_drid = drID AND wdritems_product = pID; 
   UPDATE cash_walkdr SET walkdr_amount = newDrAmnt , walkdr_totalqty = newDrQty WHERE walkdr_drid = drID; 
   UPDATE tbl_itemtotal SET total_qty = stockLeft WHERE total_product = pID;
END IF;
END


CREATE procedure Walk_dmgItems(
IN drID INTEGER,
IN pID INTEGER,
IN pQty INTEGER
)
BEGIN
DECLARE dmgExist INTEGER; DECLARE returnExist INTEGER; DECLARE itemExist INTEGER;
DECLARE itemDiff INTEGER; 
DECLARE orderItemQty INTEGER;
DECLARE drItemQty INTEGER;
DECLARE orderID INTEGER;

SELECT COUNT(dmg_product) INTO dmgExist FROM cash_walkdmg WHERE dmg_drid = drID AND dmg_product = pID;
SELECT COUNT(return_product) INTO returnExist FROM cash_walkreturn WHERE return_drid = drID AND return_product = pID;
SELECT COUNT(wdritems_product) INTO itemExist FROM cash_walkdritems WHERE wdritems_drid = drID AND wdritems_product = pID;	
SELECT wdritems_qty INTO drItemQty FROM cash_walkdritems WHERE wdritems_drid = drID AND wdritems_drid = drID AND wdritems_product =pID;
SELECT walkdr_oid INTO orderID FROM cash_walkdr WHERE walkdr_drid = drID;
SELECT woitems_qty INTO orderItemQty FROM cash_walkorderitems WHERE woitems_orderid = orderID AND woitems_product = pID;

SET itemDiff = drItemQty - orderItemQty;

IF itemDiff < 0 && itemExist !=0 && dmgExist = 0 && returnExist = 0 THEN
  INSERT INTO cash_walkdmg (dmg_drid,dmg_product,dmg_qty) VALUES (drID,pID,pQty);

END IF;
END

CREATE procedure Walk_returnItems(
In drID INTEGER,
IN pID INTEGER;
IN pQty INTEGER
)
BEGIN
ECLARE dmgExist INTEGER; DECLARE returnExist INTEGER; DECLARE itemExist INTEGER;
DECLARE itemDiff INTEGER; 
DECLARE orderItemQty INTEGER;
DECLARE drItemQty INTEGER;
DECLARE orderID INTEGER;

SELECT COUNT(dmg_product) INTO dmgExist FROM cash_walkdmg WHERE dmg_drid = drID AND dmg_product = pID;
SELECT COUNT(return_product) INTO returnExist FROM cash_walkreturn WHERE return_drid = drID AND return_product = pID;
SELECT COUNT(wdritems_product) INTO itemExist FROM cash_walkdritems WHERE wdritems_drid = drID AND wdritems_product = pID;	
SELECT wdritems_qty INTO drItemQty FROM cash_walkdritems WHERE wdritems_drid = drID AND wdritems_drid = drID AND wdritems_product =pID;
SELECT walkdr_oid INTO orderID FROM cash_walkdr WHERE walkdr_drid = drID;
SELECT woitems_qty INTO orderItemQty FROM cash_walkorderitems WHERE woitems_orderid = orderID AND woitems_product = pID;

SET itemDiff = drItemQty - orderItemQty;

IF itemDiff < 0 && itemExist !=0 && dmgExist = 0 && returnExist = 0 THEN
 INSERT INTO cash_walkreturn (return_drid,return_product,return_qty) VALUES (drID,pID,pQty);

END IF;
END
/* get the balance of the client   */
CREATE procedure ClientWarn()
BEGIN
DECLARE clientBalance FLOAT;
DECLARE clientDateOfCredit INTEGER; DECLARE poID INTEGER;
DECLARE Deadline INTEGER;
DECLARE rowCount INTEGER;
DECLARE i INTEGER;        DECLARE prevMos INTEGER;
DECLARE clientID INTEGER; DECLARE newMos INTEGER; 
DECLARE current INTEGER;  DECLARE clientDR INTEGER;
DECLARE clientID INTEGER; 
DECLARE addOn INTEGER; 

SELECT COUNT(clientdr_drid) INTO rowCount FROM cash_clientdr;
SET current = DATE_FORMAT(NOW(),"%m");


WHILE ( i < rowCount) DO
  SELECT DATE_FORMAT(DATE_ADD(client_date,INTERVAL 2 MONTH),"%m")INTO Deadline FROM cash_clientdr LIMIT i,1; 
   SELECT p.clientpo_customer INTO clientID FROM cash_clientpo p INNER JOIN cash_clientdr d ON d.cleintdr_poid = p.cleintpo_poid LIMIT i,1; 
    SELECT cb_balance INTO clientBalance FROM cash_clientbalance WHERE cb_client = clientID;
    
    IF DeadLine = current THEN 
          INSERT INTO cash_clientwarn (warn_client,warn_mos) VALUES (clientID,Deadline);      
    ELSE IF DeadLine < current THEN
          SET addOn = current - DeadLine;
          SELECT warn_mos INTO prevMos FROM cash_clientwarn WHERE warn_client = clientID;
          SET newMos = prevMos + addOn;
          UPDATE cash_clientwarn SET warn_mos = newMos WHERE warn_client = clientID;               
    END IF;
          SET i = i + 1;
END WHILE;
END






















