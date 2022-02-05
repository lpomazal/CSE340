INSERT INTO clients(clientFirstname, clientLastname, clientEmail, clientPassword, COMMENT)
VALUES ('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 'I am the real Ironman');

UPDATE clients
SET clientLevel='3'
WHERE clientFirstname = 'Tony';

DELETE FROM inventory WHERE invMake = 'Jeep';

SELECT inventory.invModel
FROM inventory
INNER JOIN carclassification ON 
inventory.invModel=carclassification.classificationName
WHERE carclassification.classificationName = 'SUV';

-- UPDATE inventory
-- SET invDescription('small interior', 'spacious interior')
-- WHERE invModel Like 'Hummer';