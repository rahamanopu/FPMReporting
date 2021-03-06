USE [DCR]
GO
/****** Object:  StoredProcedure [dbo].[usp_OrdersFirstTimeSyncDataProducts]    Script Date: 7/16/2018 6:27:15 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

ALTER PROCEDURE [dbo].[usp_OrdersFirstTimeSyncDataProducts]
	@Business AS VARCHAR(4)	
AS
--*/
SET NOCOUNT ON
SET ANSI_WARNINGS ON
/*
DECLARE
	@Business AS VARCHAR(4)	
SET @Business = 'P'
--*/

SELECT smscode AS productcode, productname, business, packsize,
	unitprice, vat
FROM [SDMSMirror].[SDMSMirror].dbo.Product
WHERE Active = 'Y'
	AND Business = @Business
	AND smscode <> '' 
	AND SMSOrder = 'Y'
ORDER BY ProductName