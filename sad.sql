Create PRocedure ClientPoItems(
 IN poID INTEGER,
 IN pId VARCHAR(20), 
 IN pQty INTEGER,
 IN drID INTEGER
)
BEGIN
DECLARE prodPrice DOUBLE;
DECLARE stock INTEGER;   DECLARE Diff INTEGER;
DECLARE prodTotalPrice DOUBLE;
DECLARE totalStock INTEGER;
DECLARE stockLeft INTEGER;
DECLARE prodExist INTEGER; DECLARE prevQty INTEGER;
DECLARE newQty INTEGER;
DECLARE prevAmnt DOUBLE;
DECLARE newAmnt DOUBLE;
DECLARE prevPoAmnt DOUBLE;
DECLARE newPoAmnt DOUBLE;

SELECT COUNT(poitem_item) INTO prodExist FROM inv_poitems
WHERE poitem_poid = poID AND poitem_item = pId; 

SELECT di_retprice INTO prodPrice FROM inv_dritems WHERE di_drid = drID AND di_items = pID; 
SELECT total_prodqty INTO totalStock FROM inv_prodtotal WHERE total_prodid = pID AND total_drid = drID; 
SELECT cpo_qty INTO prevQty FROM cash_cpoitems WHERE cpo_poid = poID AND cpoitem = pID;
SELECT cpo_amount INTO prevAmnt FROM cash_cpoitems WHERE cpo_poid = poID AND cpoitem = pID;
SELECT 

SET newQty = prevQty + pQty;
SET prodTotalPrice = prodPrice * pQty;
SET newAmnt = prevAmnt + prodTotalPrice;
SET Diff = totalStock- pQty;
 
IF pQty =< totalStock && Diff < 0  THEN
  IF prodExist != 0 THEN
    INSERT INTO cash_cpoitems(cpo_poid,cpo_item,cpo_qty,cpo_amount) VALUES 
     (poID,pId,pQty,prodTotalPrice);
   
   UPDATE cash_clientpo SET po_amnt = newAmnt WHERE po_id = poID; 
   ELSE
      UPDATE cash_cpoitems SET cpo_qty = newQty , cpo_amount = newAmnt WHERE
      cpo_poid = poID AND cpoitem = pID;  

      UPDATE cash_clientpo SET po_amnt = newAmnt WHERE po_id = poID;
  END IF;
END IF;
END	

Create PRocedure ClientDrItems(
IN poID INTEGER,
IN pID VARCHAR(20),
IN pQty INTEGER
BEGIN
DECLARE 








END

