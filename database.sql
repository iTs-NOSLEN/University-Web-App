-- database.sql
-- Creates and populates the University database.

CREATE DATABASE University;
USE University;

-- Departments table
CREATE TABLE Departments (
  DepartmentId_pk       INT NOT NULL AUTO_INCREMENT,
  Name                  VARCHAR(40) NOT NULL,
  PRIMARY KEY           (DepartmentId_pk)
);

-- Courses table
CREATE TABLE Courses (
  Code_pk               VARCHAR(6) NOT NULL,
  Title                 VARCHAR(50) NOT NULL,
  Credits               INT NOT NULL,
  DepartmentId_fk       INT NOT NULL,
  PRIMARY KEY           (Code_pk),
  FOREIGN KEY           (DepartmentId_fk) 
      REFERENCES        Departments(DepartmentId_pk)
);

-- Users Table
CREATE TABLE Users (
    Username_pk         VARCHAR(15) NOT NULL,
    Password            VARCHAR(80) NOT NULL,
    Type                CHAR(1) NOT NULL,	-- 'A' (administrator) or 'U' (regular user)
    PRIMARY KEY          (Username_pk)
);

--  Values of Departments table
INSERT INTO Departments (Name) 
    VALUES ('Business Administration');

INSERT INTO Departments (Name) 
    VALUES ('Computing');

INSERT INTO Departments (Name) 
    VALUES ('Humanities');

INSERT INTO Departments (Name) 
    VALUES ('Languages');

INSERT INTO Departments (Name) 
    VALUES ('Mathematics');

INSERT INTO Departments (Name) 
    VALUES ('Natural Science');

INSERT INTO Departments (Name) 
    VALUES ('Social Science');

-- Values of Courses table
INSERT INTO Courses (Code_pk, Title, Credits, DepartmentId_fk) 
    VALUES ('ACC301', 'Basic Accounting', 3, 1);

INSERT INTO Courses (Code_pk, Title, Credits, DepartmentId_fk) 
    VALUES ('BIO321', 'Introductory Biology', 3, 6);

INSERT INTO Courses (Code_pk, Title, Credits, DepartmentId_fk) 
    VALUES ('BIO322', 'Introductory Biology Lab', 1, 6);

INSERT INTO Courses (Code_pk, Title, Credits, DepartmentId_fk) 
    VALUES ('CHE321', 'Introductory Chemistry', 4, 6);

INSERT INTO Courses (Code_pk, Title, Credits, DepartmentId_fk) 
    VALUES ('CHE322', 'Introductory Chemistry Lab', 1, 6);

INSERT INTO Courses (Code_pk, Title, Credits, DepartmentId_fk) 
    VALUES ('CIS315', 'Databases', 3, 2);

INSERT INTO Courses (Code_pk, Title, Credits, DepartmentId_fk) 
    VALUES ('CIS415', 'Database Applications', 4, 2);

INSERT INTO Courses (Code_pk, Title, Credits, DepartmentId_fk) 
    VALUES ('ENG301', 'English Composition', 3, 4);

INSERT INTO Courses (Code_pk, Title, Credits, DepartmentId_fk) 
    VALUES ('HIS301', 'World History', 3, 3);

INSERT INTO Courses (Code_pk, Title, Credits, DepartmentId_fk) 
    VALUES ('MAT331', 'Calculus', 4, 5);

INSERT INTO Courses (Code_pk, Title, Credits, DepartmentId_fk) 
    VALUES ('MAT401', 'Discrete Math', 3, 5);

INSERT INTO Courses (Code_pk, Title, Credits, DepartmentId_fk) 
    VALUES ('PHY371', 'College Physics', 3, 6);

INSERT INTO Courses (Code_pk, Title, Credits, DepartmentId_fk) 
    VALUES ('PHY372', 'College Physics Lab', 1, 6);

INSERT INTO Courses (Code_pk, Title, Credits, DepartmentId_fk) 
    VALUES ('PSY475', 'Development Psychology', 3, 7);


-- Inserts a record into the Users table for the administrator.
INSERT INTO Users (Username_pk, Password, Type) 
    VALUES ('admin', 'X', 'A');

UPDATE Users
    SET Password = sha2('adminadmin', 256)
    WHERE Username_pk = 'admin';