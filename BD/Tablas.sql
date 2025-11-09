-- se guardan los datos de las cuentas
    CREATE TABLE Usuarios (
        IDUsuario INT PRIMARY KEY AUTO_INCREMENT,
        NombreCompleto VARCHAR(120) NOT NULL,
        Correo VARCHAR(160) NOT NULL UNIQUE,
        Telefono VARCHAR(25),
        Contrasena VARCHAR(255) NOT NULL,
        Rol VARCHAR(20) NOT NULL, -- Cliente, Asesor, Admin
        FechaRegistro DATE NOT NULL
    );
 -- tipos de propiedad: casa, departamento, terreno, oficina etc, para clasificar las propiedades se le asigna un numero
 -- algo asi: 1 - Casa, 2 - Departamento, 3 - Terreno, 4 - Oficina
CREATE TABLE TiposPropiedad (
    IDTipo INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(50) NOT NULL
);
-- los datos de la propiedades
CREATE TABLE Propiedades (
    IDPropiedad INT PRIMARY KEY AUTO_INCREMENT,
    Titulo VARCHAR(150) NOT NULL,
    Descripcion TEXT,
    Precio DECIMAL(12,2) NOT NULL,
    Direccion VARCHAR(200) NOT NULL,
    Ciudad VARCHAR(100) NOT NULL,
    Colonia VARCHAR(100),
    Superficie INT,
    Terreno INT,
    Habitaciones INT,
    Banos INT,
    Estacionamientos INT,
    Estado VARCHAR(20) NOT NULL, -- Disponible, Rentada, Vendida
    FechaPublicacion DATE NOT NULL,
    IDTipo INT NOT NULL,
    IDAsesor INT NOT NULL
);

ALTER TABLE Propiedades
ADD CONSTRAINT FK_Propiedades_Tipo
FOREIGN KEY (IDTipo) REFERENCES TiposPropiedad(IDTipo),
ADD CONSTRAINT FK_Propiedades_Asesor
FOREIGN KEY (IDAsesor) REFERENCES Usuarios(IDUsuario);

-- las amenidades son cosas como alberca, gimnasio, jardin, etc
-- tambien se le asigna un numero a cada amenidad como en los tipos de propiedad
--algo asi: 1 - Alberca, 2 - Gimnasio, 3 - Jardin, 4 - Parrilla
CREATE TABLE Amenidades (
    IDAmenidad INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(60) NOT NULL
);

-- esta es para conectar las propiedades con sus amenidades
CREATE TABLE PropiedadAmenidad (
    IDPropiedad INT NOT NULL,
    IDAmenidad INT NOT NULL,
    PRIMARY KEY (IDPropiedad, IDAmenidad)
);

ALTER TABLE PropiedadAmenidad
ADD CONSTRAINT FK_PA_Propiedad
FOREIGN KEY (IDPropiedad) REFERENCES Propiedades(IDPropiedad),
ADD CONSTRAINT FK_PA_Amenidad
FOREIGN KEY (IDAmenidad) REFERENCES Amenidades(IDAmenidad);

-- este es para el filtro, guarda las configuraciones que el cliente prefiere
-- sirve para mostrar las propiedades que coincidan con sus gustos
CREATE TABLE PreferenciasCliente (
    IDPreferencia INT PRIMARY KEY AUTO_INCREMENT,
    IDUsuario INT NOT NULL,
    IDTipo INT,
    Ciudad VARCHAR(100),
    Colonia VARCHAR(100),
    PresupuestoMin DECIMAL(12,2),
    PresupuestoMax DECIMAL(12,2),
    MinHabitaciones INT,
    MinBanos INT,
    MinEstacionamientos INT,
    FechaActualizacion DATE NOT NULL
);

ALTER TABLE PreferenciasCliente
ADD CONSTRAINT FK_Pref_Usuario
FOREIGN KEY (IDUsuario) REFERENCES Usuarios(IDUsuario),
ADD CONSTRAINT FK_Pref_Tipo
FOREIGN KEY (IDTipo) REFERENCES TiposPropiedad(IDTipo);

-- Como no se hacer de que recomiende en base al historial mejor directamente puse una seccion de historial
--asi revisa propiedades que ya vio el usuario
CREATE TABLE Historial (
    IDHistorial INT PRIMARY KEY AUTO_INCREMENT,
    IDUsuario INT NOT NULL,
    IDPropiedad INT NOT NULL,
    FechaHora DATETIME NOT NULL,
    DuracionSegundos INT DEFAULT NULL  -- opcional: tiempo que el usuario estuvo en la ficha
);

ALTER TABLE Historial
ADD CONSTRAINT FK_Hist_Usuario
FOREIGN KEY (IDUsuario) REFERENCES Usuarios(IDUsuario),
ADD CONSTRAINT FK_Hist_Propiedad
FOREIGN KEY (IDPropiedad) REFERENCES Propiedades(IDPropiedad);

-- la tabla de citas para que los clientes puedan agendar visitas a las propiedades

CREATE TABLE Citas (
    IDCita INT PRIMARY KEY AUTO_INCREMENT,
    IDUsuario INT NOT NULL,  -- Cliente
    IDPropiedad INT NOT NULL,
    IDAsesor INT NOT NULL,
    FechaCita DATE NOT NULL,
    Estado VARCHAR(20) NOT NULL -- Pendiente, Confirmada, Cancelada, Completada
);


ALTER TABLE Citas
ADD CONSTRAINT FK_Cita_Usuario
FOREIGN KEY (IDUsuario) REFERENCES Usuarios(IDUsuario),
ADD CONSTRAINT FK_Cita_Propiedad
FOREIGN KEY (IDPropiedad) REFERENCES Propiedades(IDPropiedad),
ADD CONSTRAINT FK_Cita_Asesor
FOREIGN KEY (IDAsesor) REFERENCES Usuarios(IDUsuario);
    

-- la tabla de los datos de agentes para poderles dar diferentes permisos que a los usuarios normales
CREATE TABLE Agentes (
    IDAgente INT PRIMARY KEY AUTO_INCREMENT,
    IDUsuario INT NOT NULL,
    CodigoAgente VARCHAR(50) NOT NULL,
    Especialidad VARCHAR(100),
    Experiencia INT, -- Años de experiencia
    ZonaAsignada VARCHAR(100),
    Comision DECIMAL(5,2), -- Porcentaje de comisión
    Estado VARCHAR(20) NOT NULL, -- Activo, Inactivo
    FechaRegistro DATE NOT NULL
);

ALTER TABLE Agentes
ADD CONSTRAINT FK_Agente_Usuario
FOREIGN KEY (IDUsuario) REFERENCES Usuarios(IDUsuario);

--estas 2 aun siento que son algo opcionales, valoraciones por si los usuarios dejan opiniones para mostrarlas en la pagina
-- y la de imagenes para que cada propiedad tenga varias fotos
--pero la de imagenes las va a tener que sacar de un servidor si la maestra pide que lo subamos a algun lado


CREATE TABLE Valoraciones (
    IDValoracion INT PRIMARY KEY AUTO_INCREMENT,
    IDUsuario INT NOT NULL,   -- quien califica
    IDAgente INT,            -- opcional: calificar al agente
    IDPropiedad INT,         -- opcional: calificar la propiedad (visita, atención)
    Puntuacion TINYINT NOT NULL, -- 1..5
    Comentario TEXT,
    Fecha DATE NOT NULL
);

ALTER TABLE Valoraciones
ADD CONSTRAINT FK_Val_Usuario
FOREIGN KEY (IDUsuario) REFERENCES Usuarios(IDUsuario),
ADD CONSTRAINT FK_Val_Agente
FOREIGN KEY (IDAgente) REFERENCES Agentes(IDAgente),
ADD CONSTRAINT FK_Val_Propiedad
FOREIGN KEY (IDPropiedad) REFERENCES Propiedades(IDPropiedad);


-- -- PropiedadImagenes
-- CREATE TABLE PropiedadImagenes (
--     IDImagen INT PRIMARY KEY AUTO_INCREMENT,
--     IDPropiedad INT NOT NULL,
--     RutaArchivo VARCHAR(255) NOT NULL, -- URL o path en servidor
--     EsPortada TINYINT(1) DEFAULT 0,
--     OrdenSmall INT DEFAULT 0,
--     FechaSubida DATE NOT NULL
-- );

-- ALTER TABLE PropiedadImagenes
-- ADD CONSTRAINT FK_Img_Propiedad
-- FOREIGN KEY (IDPropiedad) REFERENCES Propiedades(IDPropiedad);


