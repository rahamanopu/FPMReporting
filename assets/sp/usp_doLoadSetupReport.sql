--/*
ALTER PROCEDURE usp_doLoadSetupReport
	@Category		VARCHAR(100),
	@BusinessCode	VARCHAR(5),
	@LocationCode	VARCHAR(5),
	@MaterialType	VARCHAR(5),
	@MaterialCode	VARCHAR(10),
	@PageLimit 		INT = 20,
	@pageNumber		VARCHAR(3) = 1
AS
--*/

/*
DECLARE @Category		VARCHAR(100)
DECLARE @BusinessCode	VARCHAR(5)
DECLARE @LocationCode	VARCHAR(5)
DECLARE @MaterialType	VARCHAR(5)
DECLARE @MaterialCode	VARCHAR(10)
DECLARE	@PageLimit 		INT
DECLARE	@pageNumber		VARCHAR(3)

SET @Category = 'buffersize'
SET @BusinessCode = ''
SET @LocationCode = ''
SET @MaterialType = ''
SET @MaterialCode = ''
SET @PageLimit = '20'
SET @pageNumber = '1'
--*/
DECLARE @Query VARCHAR(8000)

CREATE TABLE #temp(
	SL INT NOT NULL IDENTITY(1,1),
	[Business] [varchar](100) NOT NULL,
	[Location] [varchar](100) NOT NULL,
	[Material_Type] [varchar](100) NOT NULL,
	[Material] [varchar](100) NOT NULL,
	[EffectiveDate] [datetime] NOT NULL
)

SET @Query = 'ALTER TABLE #temp ADD '+@Category+' NUMERIC(18,2)'
EXEC ( @Query ) 

SET @Query  = '
			SELECT
				M.BusinessCode + '' - '' + B.BusinessName Business,
				M.LocationCode + '' - '' + L.LocationName Location,
				M.MaterialTypeCode + '' - '' + MT.MaterialTypeName Material_Type,
				M.MaterialCode + '' - '' + MA.MaterialName Material,	
				EffectiveDate Effective_Date,
				'+@Category+'
			FROM '+@Category+' M
				LEFT JOIN Business B
					ON M.BusinessCode = B.BusinessCode
				LEFT JOIN Location L
					ON M.LocationCode = L.LocationCode 
				LEFT JOIN MaterialType MT
					ON M.MaterialTypeCode = MT.MaterialTypeCode
				LEFT JOIN Material MA
					ON M.MaterialCode = MA.MaterialCode
			WHERE ('''+@BusinessCode+''' = '''' OR  M.BusinessCode = '''+@BusinessCode+''')
				AND ('''+@LocationCode+''' = '''' OR  M.LocationCode = '''+@LocationCode+''')
				AND ('''+@MaterialType+''' = '''' OR  M.MaterialTypeCode = '''+@MaterialType+''')
				AND ('''+@MaterialCode+''' = '''' OR  M.MaterialCode = '''+@MaterialCode+''')
			ORDER BY 1,2,3,4 ASC, 5,6 DESC'
PRINT @Query
INSERT INTO #temp EXEC (@Query)


SELECT 
	CASE WHEN @PageLimit=0 THEN 1 ELSE ((SL-1)/@PageLimit) +1 END AS PageNo, * 
FROM #temp
WHERE CASE WHEN @PageLimit=0 THEN 1 ELSE ((SL-1)/@PageLimit) +1 END LIKE @pageNumber
ORDER BY Sl

SELECT 
	DISTINCT CASE WHEN @PageLimit=0 THEN 1 ELSE ((SL-1)/@PageLimit) +1 END AS PageNo 
FROM #temp
ORDER BY CASE WHEN @PageLimit=0 THEN 1 ELSE ((SL-1)/@PageLimit) +1 END


DROP TABLE #temp