# Prueba Técnica - Sistema de Gestión de Clientes - José Eduardo Allende Téllez

Este proyecto corresponde a la "Prueba de conocimiento sináptico".
El objetivo es demostrar mi conocimiento de HTML, CSS y un poco de Bases de datos y estructuras generales.

# Tecnologías utilizadas
-HTML5
-CSS3-
-MYSQL (MySQL Workbench)

Sin uso de PHP ni frameworks, tal como se acordó con el entrevistador; únicamente utilizando todos mis conocimientos de forma honesta y profesional.

# Para BASES DE DATOS
Se generó un esquema llamado `clientes` y una tabla con los siguientes campos:

- id (INT, auto_increment, PK)  
- nombre  
- apellido_paterno  
- apellido_materno  
- fecha_nacimiento  

También se añadieron registros de prueba para simular el comportamiento del sistema.

# HTML
El proyecto incluye 5 programas indicadas en la prueba:

1. Crear cliente - index.html
    -Este es el formulario simulado para capturar los datos de un nuevo cliente. Lo he puesto como archivo principal.
2. Mostrar lista de clientes - clientes.html
    -Esta es una tabla que muestra todos los clientes con sus acciones:
    -Ver detalles
    -Modificar
    -Eliminar
    -Botón "Agregar nuevo" que dirige a la página de crear cliente (index.html)

3. Link de ver detalles (ver_detalles.html)
    -Muestra sin edición todos los datos del cliente que se haya seleccionado

4. Link de Modificar (modificar_cliente.html)
    -Este es el formulario con los datos precargados y el botón que dice: "Modificar datos"
    -Contiene boton de cancelar que regresa a la página de (clientes.html)

5. Eliminar cliente (confirmar_eliminar.html)
    -Aquí sale la pantalla de confirmación con botones "Borrar cliente" y "Cancelar"

# CSS
Utilicé un archivo separado para los estilos (styles.css)
    -Para mantener orden y claridad en el proyecto al agregarle estilos.

# Estructura del proyecto
/prueba_JoseEduardoAllendeTellez
│
├── index.html
├── clientes.html
├── ver_detalles.html
├── modificar_cliente.html
├── confirmar_eliminar.html
├── styles.css
└── README.md