Portfolio Web — Ángel

Aplicación web tipo portfolio desarrollada sin frameworks, orientada a presentar proyectos, habilidades y contenidos de forma estructurada y navegable.

Tecnologías
PHP (sin framework)
HTML + CSS
JavaScript (ES Modules)
Apache (XAMPP)
Arquitectura

El proyecto sigue una arquitectura MVC ligera:

Entrada única: public/index.php
Routing: mediante parámetro ?v=
Vistas: renderizadas en PHP
Layout base: estructura común con header, contenido y footer
Frontend JS: controladores por vista cargados dinámicamente
Funcionalidades principales
Navegación por secciones (Home, Skills, Projects, Gallery, Contact)
Galería de imágenes con lightbox interactivo
Sistema de escritos ("Writings"):
Listado dinámico desde archivos .txt
Vista de detalle con renderizado de contenido
Fondo dinámico con efecto blur desacoplado del texto
Gestión de contenido

El sistema no utiliza base de datos.

Los escritos se almacenan como archivos:

/app/data/writings/
    1.txt
    2.txt

Formato:

Título
---
Contenido...
Decisiones técnicas
Sin frameworks (control total del flujo)
Separación clara de responsabilidades (PHP / JS / CSS)
Uso de sistema de archivos como fuente de datos
Reutilización de componentes (gallery → writings)
Estado del proyecto

Actualmente funcional en:

Routing
Render de vistas
Galería interactiva
Sistema completo de escritos


*********************************************************************
*********************************************************************


Portfolio Web — Ángel
A web-based portfolio application built without frameworks, designed to present projects, skills, and content in a structured and navigable way.

Technologies
PHP (no framework)
HTML + CSS
JavaScript (ES Modules)
Apache (XAMPP)
Architecture

The project follows a lightweight MVC approach:

Single entry point: public/index.php
Routing: handled via ?v= parameter
Views: rendered using PHP
Base layout: shared structure with header, content, and footer
Frontend JS: view-based controllers loaded dynamically
Main Features
Navigation across sections (Home, Skills, Projects, Gallery, Contact)
Image gallery with interactive lightbox
Writings system:
Dynamic listing from .txt files
Detail view with parsed content rendering
Dynamic background with blur effect separated from text
Content Management

No database is used.

Writings are stored as files:

/app/data/writings/
    1.txt
    2.txt

Format:

Title
---
Content...
Technical Decisions
No frameworks (full control over flow)
Clear separation of concerns (PHP / JS / CSS)
File-based content system
Component reuse (gallery → writings)
Project Status

Currently functional in:

Routing
View rendering
Interactive gallery
Complete writings system
*********************************************************************
*********************************************************************
*********************************************************************
*********************************************************************
