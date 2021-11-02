ALTER PROCEDURE usp_doInsertBufferSize
	@BusinessCode			VARCHAR(5),
	@LocationCode			VARCHAR(5),
	@MaterialTypeCode		VARCHAR(2),
	@MaterialCode			VARCHAR(10),
	@BufferSize				NUMERIC(18,2),
	@EffectiveDate			DATETIME,
	@EntryBy				VARCHAR(10),
	@EntryIpAddress			VARCHAR(30)
AS

/*
DECLARE @BusinessCode			VARCHAR(5),
		@LocationCode			VARCHAR(5),
		@MaterialTypeCode		VARCHAR(2),
		@MaterialCode			VARCHAR(10),
		@BufferSize				NUMERIC(18,2),
		@EffectiveDate			DATETIME,
		@EntryBy				VARCHAR(10),
		@EntryIpAddress			VARCHAR(30)


SET @BusinessCode			= 'H'
SET @LocationCode			= '82'
SET @MaterialTypeCode		= 'PM'
SET @MaterialCode			= '0105000013'
SET @BufferSize				= '12'
SET @EffectiveDate			= '2018-07-15'
SET @EntryBy				= '11936'
SET @EntryIpAddress			= '192.168.62.221'
-- created by		: zillur
-- created date		: 16-07-2018
--*/

IF NOT EXISTS (SELECT * FROM BufferSize WHERE BusinessCode	= @BusinessCode AND LocationCode = @LocationCode
		AND MaterialTypeCode = @MaterialTypeCode AND MaterialCode = @MaterialCode 
		AND EffectiveDate = @EffectiveDate)
		BEGIN
			INSERT INTO BufferSize 
				(BusinessCode, LocationCode, MaterialTypeCode, MaterialCode, 
					BufferSize, EffectiveDate, EntryBy, EntryIpAddress) 
				VALUES 
				(@BusinessCode, @LocationCode, @MaterialTypeCode, @MaterialCode,
					@BufferSize, @EffectiveDate, @EntryBy, @EntryIpAddress)
		END
	ELSE 
		BEGIN
			UPDATE BufferSize SET
				BufferSize = @BufferSize,
				EditedDate = GETDATE(),
				EditedBy = @EntryBy,
				EditedIpAddress = @EntryIpAddress
			WHERE BusinessCode	= @BusinessCode AND LocationCode = @LocationCode
				AND MaterialTypeCode = @MaterialTypeCode AND MaterialCode = @MaterialCode 
				AND EffectiveDate = @EffectiveDate
		END