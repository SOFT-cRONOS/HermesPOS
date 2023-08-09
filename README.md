# Proyecto HermesPOS

## Hermes punto de venta

Sistema con finalidad para puntos de ventas genericos, multiuso.
Completamente gratis pero con la finalidad de poder comercializar su puesta a punto.

## Funciones del software

**Login**
- Login con usuario y contraseña
- Recuperar contraseña
- Solicitar registro

**Punto de venta**
- Vender
    -Nueva orden
    -Nueva transaccion (Presupuesto, Pedido, Venta)
    -Entregas pendientes
    -Pedidos pendientes
    -Reportes de ventas
- Clientes
    -Agenda
    -Nuevo Cliente
    -Reportes
    -Sistema de puntos (A futuro)

**Articulos**
- Listado de productos
    -Recuento de inventario
    -Control de precios compra
    -Exportar listado
    -Importar listado
- Nuevo producto
    -producto simple
    -producto compuesto
- Descuentos
    -Por cantidad
    -Por categoria
- Historial de inventario
    -Proveedores
- Categorias
    
**Configuracion**
- Usuarios
    -Nuevo Usuario
    -Usuarios conectados
    -chat(a futuro)
- Preferencias
    -Empresa
    -Impustos
    -Descuentos
    -Ganancias
    -Permisos de usuario
    -Alarma de stock
    -Metodos de pago
    -Pantalla pedidos(a futuro)

## Estructura de archivos 
    proyecto
    │ README.md
    │ index.php 
    ├── Admin (logeo y configuracion)
    │   ├── conect.php
    │   ├── logout.php
    │   └── troubleshooting.md
    │
    ├── css (estilos propios)
    ├── database (configuracion de BD)
    │   ├──crearBD.sql
    │   ├──doagramabd.dia  
    ├──modules(funciones de control)
    ├──pages(paginas de la UI)
    │   ├──blocks(bloques html reutilizbles)
    │   ├──clientes.php
    │   ├──productos.php
    **Etc..**
## Datos ingreso

    Administrador
        usuario: admin
        pass: hermespos