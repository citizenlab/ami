CREATE TABLE IF NOT EXISTS stats
(
	request_id VARCHAR(64),
	company VARCHAR(256),
	request_lang CHAR(2),
	request_date DATETIME,
	PRIMARY KEY (request_id)
);