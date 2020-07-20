CREATE DATABASE w1714855_0;
CREATE TABLE Product(
prodId int(4) AUTO_INCREMENT,
prodName varchar(30) NOT NULL,
prodPicNameSmall varchar(100) NOT NULL,
prodPicNameLarge varchar(100) NOT NULL,
prodDescripShort varchar(1000),
prodDescripLong varchar(3000),
prodPrice DECIMAL(6,2) NOT NULL,
prodQuantity INT(4) NOT NULL,
CONSTRAINT pro_proid_pk PRIMARY KEY(prodId)
);

INSERT INTO Product (prodName, prodPicNameSmall, prodPicNameLarge, prodDescripShort, prodDescripLong, prodPrice, prodQuantity) VALUES(
"Smart Home Cam", 
    "product1_small.jpg",
    "product1_large.jpg", 
    'Record clips to your smart device with a motion detection sensor, with alerts and snapshots to your mobile device', 
    "Our Smart Home cam comes with advanced night vision with multiple IR sensors. Which means that you can get excellent quality night video streaming even in complete darkness. So you can see what your pets are up to when you are not around!",
    49.99, 
20);

INSERT INTO Product (prodName, prodPicNameSmall, prodPicNameLarge, prodDescripShort, prodDescripLong, prodPrice, prodQuantity) VALUES(
"iPad", 
    "product2_small.jpg",
    "product2_large.jpg","Last year's entry-level iPad felt like the love child of the original iPad Air and the iPad Air 2. This one, not surprisingly, feels much the same. The color options are the same: Silver, space gray, and gold. So is the design, all bezels and Touch ID.", 
    "Our Smart Home cam comes with advanced night vision with multiple IR sensors. Which means that you can get excellent quality night video streaming even in complete darkness. So you can see what your pets are up to when you are not around!",
    359.90, 
40);

INSERT INTO Product (prodName, prodPicNameSmall, prodPicNameLarge, prodDescripShort, prodDescripLong, prodPrice, prodQuantity) VALUES(
'55" Class TU8000 Crystal UHD 4K Smart TV', 
    "product3_small.jpg",
    "product3_large.jpg", 
    'Experience crystal clear colors that are fine-tuned to deliver a naturally crisp and vivid picture.', 
    "Experience your favorite movies and shows on a vibrant, stunning 4K UHD screen, using the Universal Guide to surf smoothly and select content. Everything you watch is automatically upscaled into 4K for stunningly vivid color and detail.",
    499.99, 60);

INSERT INTO Product (prodName, prodPicNameSmall, prodPicNameLarge, prodDescripShort, prodDescripLong, prodPrice, prodQuantity) VALUES('28 cu. ft. 4-Door French Door Refrigerator with 21.5” Touch Screen Family Hub™ in Stainless Steel', 
    "product4_small.jpg",
    "product4_large.jpg","FlexZone Drawer - A flexible drawer with four different temperature settings for flexible storage.
Metal Cooling - Locks in cold and seals in freshness.", "Standard Features
External Filtered Water and Ice DispenserYes
Cooling SystemTriple Cooling
Surround Air FlowYes", 2899.00, 6)


CREATE TABLE Users(
userId int(4) AUTO_INCREMENT,
userType varchar(1) NOT NULL,
userFName varchar(50) NOT NULL,
userSName varchar(50) NOT NULL,
userAddress varchar(50) NOT NULL,
userPostCode varchar(50) NOT NULL,
userTelNo varchar(50) NOT NULL,
userEmail varchar(50) NOT NULL,
userPassword varchar(50) NOT NULL,
CONSTRAINT user_userid_pk PRIMARY KEY(userId)
);
CREATE TABLE Orders(
orderNo int(4) AUTO_INCREMENT,
userId int(4) NOT NULL,
orderDateTime DateTime NOT NULL,
orderTotal decimal(8,2) NOT NULL DEFAULT 0.0,
CONSTRAINT order_orderno_pk PRIMARY KEY(orderNo),
CONSTRAINT order_userid_fk FOREIGN KEY (userId)
    REFERENCES Users(userId)
);

CREATE TABLE Order_Line(
orderlineId int(4) AUTO_INCREMENT,
orderNo int(4) NOT NULL,
prodId int(4) NOT NULL,
quantityOrdered int(4) NOT NULL,
subTotal decimal(8,2) NOT NULL DEFAULT 0.0,
CONSTRAINT orderl_orderlno_pk PRIMARY KEY(orderlineId),
CONSTRAINT orderl_prodid_fk FOREIGN KEY (prodId)
    REFERENCES Product(prodId),
CONSTRAINT orderl_orderno_fk FOREIGN KEY (orderNo)
    REFERENCES Orders(orderNo)
);

ALTER TABLE Orders
ADD orderStatus VARCHAR(100) NOT NULL;

CREATE TABLE WishList(
prodId int(4) NOT NULL,
userId int(4) NOT NULL,
CONSTRAINT wishlist_wid_pk PRIMARY KEY(prodId, userId),
CONSTRAINT wishlist_prodid_fk FOREIGN KEY (prodId)
    REFERENCES Product(prodId),
CONSTRAINT wishlist_userid_fk FOREIGN KEY (userId)
    REFERENCES Users(userId)
);