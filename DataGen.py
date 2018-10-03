import random

# CONSTANTS --------------------------
products = [
    # Format ("(productID, productName, category, supplier, price)", productID)
    ("(1,'Lemsip','Cold and flu','Lemsip',13.00)", 1),
    ("(2,'Vapodrops','Cold and flu','Vapodrops',5.00)", 2),
    ("(3,'Codral Tablets','Cold and flu','Codral',17.00)", 3),
    ("(4,'Betadine','Cold and flu','Betadine',8.00)", 4),
    ("(5,'Sambucol','Cold and flu','Sambucol',22.00)", 5),
    ("(6,'Betadine Sore Throat','Cold and flu','Betadine',9.00)", 6),
    ("(7,'Panadol Cold and Flu max','Cold and flu','Panadol',9.80)", 7),
    ("(8,'Dimetapp','Cold and flu','Dimetapp',9.40)", 8),
    ("(9,'Ki Immune Defence Formula','Cold and flu','Ki',29.00)", 9),
    ("(10,'Ki Cold and Flu','Cold and flu','Ki',17.00)", 10),
    ("(11,'Ki Kids Liquid Formula','Cold and flu','Ki',19.00)", 11),
    ("(12,'Demazin nasal spray','Cold and flu','Demazin',9.49)", 12),
    ("(13,'Demazin tablets','Cold and flu','Demazin',9.20)", 13),
    ("(14,'Vicks Action Cold and Flu','Cold and flu','Vicks',10.00)", 14),
    ("(15,'Vicks Action Nasal Relief','Cold and flu','Vicks',11.00)", 15),
    ("(16,'Band Aid Strips 40','First Aid','Band Aid',5.49)", 16),
    ("(17,'Band Aid Strips 10 pack','First Aid','Band Aid',3.49)", 17),
    ("(18,'Band Aid Adhesive Bandages','First Aid','Band Aid',4.49)", 18),
    ("(19,'Elastoplast Strips','First Aid','Elastoplast',2.49)", 19),
    ("(20,'Savlon Antiseptic Cream','First Aid','Savlon',4.49)", 20),
    ("(21,'Dettol Disinfectant','First Aid','Detttol',9.49)", 21),
    ("(22,'Astrix 140 Capsules','Aspirin','Astrix',12.49)", 22),
    ("(23,'Mayne Aspirin 110','Aspirin','Mayne',9.49)", 23),
    ("(24,'Cartia 28 Tablets','Aspirin','Cartia',4.49)", 24)
]


# number of purchase batches
numPurchasesBatches = 25

# number of sales batches
numSalesBatches = 25

# total amount of items purchased and sold
totalPurPerItem = 2500
totalSalePerItem = 2000

# How many batches per product there should be, and the variance
batchesPerProduct = 7
batchesPerProductVariance = 2


# date range (year, month, day)
startDate = (2018, 1, 1)
endDate = (2019, 12, 28)

# expiry date range (year, month, day)
exStartDate = (2020, 1, 1)
exEndDate = (2022, 12, 31)


# GLOBAL VARIABLES --------------------------
purchases = []
sales = []

purBatches = {}
salesBatches = {}

purBatchDates = {}
salesBatchDates = {}


def SetGeneratorValues():
    for i in range(products.__len__()):
        purBatchNums = [[random.randrange(0, numPurchasesBatches), 0] for i in range(random.randrange(batchesPerProduct - batchesPerProductVariance, batchesPerProduct + batchesPerProductVariance))]

        while True:
            batches = [batch[0] for batch in purBatchNums]
            if len(batches) == len(set(batches)):
                break
            purBatchNums = [[random.randrange(0, numPurchasesBatches), 0] for i in range(
                random.randrange(batchesPerProduct - batchesPerProductVariance,
                                 batchesPerProduct + batchesPerProductVariance))]

        purRandSet = [random.randint(1, 10) for j in range(purBatchNums.__len__())]
        purRandSum = sum(purRandSet)

        count = 0
        for batch in purBatchNums:
            batch[1]  = int(purRandSet[count] / purRandSum * totalPurPerItem)
            count += 1

        purBatches[i] = purBatchNums


        saleBatchNums = [[random.randrange(0, numSalesBatches), 0] for i in range(random.randrange(batchesPerProduct - batchesPerProductVariance, batchesPerProduct + batchesPerProductVariance))]

        while True:
            batches = [batch[0] for batch in saleBatchNums]
            if len(batches) == len(set(batches)):
                break
            saleBatchNums = [[random.randrange(0, numSalesBatches), 0] for i in range(
                random.randrange(batchesPerProduct - batchesPerProductVariance,
                                 batchesPerProduct + batchesPerProductVariance))]

        saleRandSet = [random.randint(1, 10) for j in range(saleBatchNums.__len__())]
        saleRandSum = sum(saleRandSet)

        count = 0
        for batch in saleBatchNums:
            batch[1]  = int(saleRandSet[count] / saleRandSum * totalPurPerItem)
            count += 1

        salesBatches[i] = saleBatchNums

    for i in range(numPurchasesBatches):
        date = (random.randrange(startDate[0], endDate[0]),
                random.randrange(startDate[1], endDate[1]),
                random.randrange(startDate[2], endDate[2]))
        purBatchDates[i] = date

    for i in range(numSalesBatches):
        date = (random.randrange(startDate[0] , endDate[0]),
                random.randrange(startDate[1] , endDate[1]),
                random.randrange(startDate[2] , endDate[2]))
        salesBatchDates[i] = date

def CreateProducts(file):
    for p in products:
        file.write("INSERT INTO product\n")
        file.write("(productID, productName, category, supplier, price)\n")
        file.write("VALUES" + p[0] + ";\n")

    file.write("\n\n")

def GeneratePurchases(file):
    for p in products:
        for batch in purBatches[p[1] - 1]:
            exDate = (random.randrange(exStartDate[0] - 1, exEndDate[0] + 1),
                      random.randrange(exStartDate[1] - 1, exEndDate[1] + 1),
                      random.randrange(exStartDate[2] - 1, exEndDate[2] + 1))
            file.write("INSERT INTO purchases\n")
            file.write("(purchaseID, productID, purchaseDate, expiryDate, quantityRemaining, available)\n")
            file.write("VALUES(" + str(batch[0]) +
                       "," + str(p[1]) +
                       ",'" + str(purBatchDates[batch[0]][0]) + "-" +  str(purBatchDates[batch[0]][1]) + "-" + str(purBatchDates[batch[0]][2])  +
                       "','" + str(exDate[0]) + "-" + str(exDate[1]) + "-" + str(exDate[2]) +
                       "'," + str(batch[1]) +
                       ",1);\n")

    file.write('\n\n')

def GenerateSales(file):
    for p in products:
        for batch in salesBatches[p[1] - 1]:
            file.write("INSERT INTO sales\n")
            file.write("(orderID, productID, recordDate, quantity)\n")
            file.write("VALUES(" + str(batch[0]) +
                       "," + str(p[1]) +
                       ",'" + str(purBatchDates[batch[0]][0]) + "-" +  str(purBatchDates[batch[0]][1]) + "-" + str(purBatchDates[batch[0]][2])  +
                       "'," + str(batch[1]) +
                       ");\n")

    file.write('\n\n')

def GenerateInventory(file):
    for p in products:
        file.write("INSERT INTO inventory\n")
        file.write("(productID, totalQuantity)\n")
        file.write("VALUES(" + str(p[1]) + "," + str(totalPurPerItem - totalSalePerItem) + ");\n")

if __name__ == '__main__':
    data = open("data.sql", "w")
    SetGeneratorValues()
    CreateProducts(data)
    GeneratePurchases(data)
    GenerateSales(data)
    GenerateInventory(data)