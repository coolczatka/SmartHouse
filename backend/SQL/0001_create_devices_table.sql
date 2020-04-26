CREATE TABLE devices (
	id INTEGER,
	name TEXT(50),
	is_working INTEGER DEFAULT 1,
	settings TEXT,
	CONSTRAINT devices_PK PRIMARY KEY (id)
);
