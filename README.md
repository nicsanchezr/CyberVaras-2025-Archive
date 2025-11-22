# 🛡️ CyberVaras 2025 - Archivo del Campeonato

Este repositorio contiene el respaldo completo de la infraestructura, desafíos y configuraciones del **Quinto Campeonato de Ciberseguridad CyberVaras**, organizado por **DuocUC Sede Antonio Varas** (2025).

El objetivo de este archivo es preservar el trabajo realizado, permitir la revisión académica de los desafíos y facilitar el despliegue de futuras ediciones o entornos de práctica.

---

## 📂 Estructura del Repositorio

El repositorio está organizado en tres componentes principales:

- **`desafios_web/`**: Código fuente de los retos (PHP, SQLite, HTML).
    - `desafio_sql/`: Inyecciones SQL.
    - `desafio_xxe/`: Vulnerabilidades XML.
    - `desafio_jwt/`: Manipulación de Tokens.
    - *... (otros desafíos aislados)*
- **`ctfd_config/`**: Configuración de la plataforma de puntaje.
    - `docker-compose.yml`
    - `cybervaras-theme/`: Tema visual personalizado.
- **`server_config/`**: Configuraciones de infraestructura.
    - `nginx_desafio.conf`
    - `nginx_ctfd.conf`

---

## 🚩 Lista de Desafíos

A continuación se detallan los desafíos desarrollados para esta competencia, categorizados por tipo de vulnerabilidad:

### 🌐 Web Hacking
| Nombre del Desafío | Vulnerabilidad / Técnica |
| :--- | :--- |
| **El Buscador Olvidado** | SQL Injection (Básico) |
| **Fuga de Credenciales** | SQL Injection (UNION Based) |
| **El Guardián** | SQL Injection (WAF Bypass / Blind) |
| **El Bastión (Multistage)** | Blind SQLi + Cookie Manipulation + Command Injection |
| **Carga Comprometida** | Unrestricted File Upload |
| **La Tienda de Puntos** | Business Logic Error (Parameter Tampering) |
| **Perfil de Usuario** | IDOR (Insecure Direct Object Reference) |
| **El Lector de Noticias** | XXE (XML External Entity) |
| **Panel SCADA** | Command Injection (Oculto) |
| **El Oráculo** | Blind Command Injection (Time-based) |
| **Portal de Administración** | JWT Manipulation (Alg: None) |
| **La Galleta de la Fortuna** | Cookie Manipulation (Privilege Escalation) |
| **El Truco del Cero** | PHP Type Juggling |
| **El Traductor** | LFI (Local File Inclusion) con Wrappers |
| **El Mensajero Interno** | SSRF (Server-Side Request Forgery) |
| **El Despertar Maligno** | Insecure Deserialization (PHP) |

### 🕵️ Reconocimiento & OSINT
| Nombre del Desafío | Técnica |
| :--- | :--- |
| **El Índice Prohibido** | Enumeración (`sitemap.xml`) |
| **Una Pregunta Indiscreta** | Métodos HTTP (`OPTIONS`) |
| **Las Reglas del Robot** | Enumeración (`robots.txt`) |
| **La Nota Olvidada** | Análisis de Código Fuente (HTML Comments) |
| **El Encabezado Secreto** | Análisis de Cabeceras HTTP |

### 🔍 Forense & Criptografía
| Nombre del Desafío | Técnica |
| :--- | :--- |
| **El Fantasma del Commit** | Análisis Forense de Git (`.git` expuesto) |
| **La Imagen Misteriosa** | Esteganografía (Metadatos EXIF) |
| **El Manuscrito Cifrado** | Decodificación Base64 |
| **La Contraseña Olvidada** | Cracking de Hashes (MD5) |
| **El Agente Secreto** | User-Agent Spoofing |


---

## ⚠️ Aviso Legal

Este material ha sido creado exclusivamente con fines educativos y académicos para el campeonato CyberVaras de DuocUC. Las vulnerabilidades presentes en el código (`desafios_web`) son intencionales. **No desplegar este código en entornos de producción o servidores expuestos sin la debida segmentación.**

---

**Autor:** Docente: Nicolás Sánchez R.  
**Evento:** CyberVaras 2025  
**Institución:** DuocUC Sede Antonio Varas
