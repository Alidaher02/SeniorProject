# 🚢 ShipTrack

### Intelligent IoT-Based Shipment Monitoring & Tracking System

ShipTrack is an intelligent **IoT-based shipment monitoring and tracking system** designed to monitor cargo conditions and shipment location in real time during transportation.

The system combines **IoT sensors, GPS tracking, Laravel, PostgreSQL, REST APIs, automated alerts, AI, PDF reporting, and email notifications** into one integrated platform.

ShipTrack continuously collects environmental and location data from an **ESP32 microcontroller**, sends the data to a Laravel backend through a REST API, stores the readings in PostgreSQL, and presents the information through an administrative monitoring dashboard.

The system can detect abnormal shipment conditions, generate automatic alerts, track the shipment's GPS location, generate shipment reports, and provide an **AI-powered Shipment Assistant** capable of answering questions about shipment status, sensor readings, alerts, and reports.

---

## ✨ Key Features

### 📦 Shipment Management

* Create and manage shipments
* Store product information
* Generate and manage tracking numbers
* Define shipment origin and destination
* Configure acceptable temperature ranges
* Monitor shipment status
* Associate shipments with IoT sensor data

### 🌡️ Real-Time IoT Monitoring

ShipTrack collects real-time information from sensors connected to the ESP32:

* 🌡️ Temperature
* 💧 Humidity
* 📍 GPS location
* 📐 Tilt
* 💡 Light

The collected readings are transmitted to the Laravel backend and stored in PostgreSQL.

### 📍 GPS Shipment Tracking

The system uses GPS data to monitor the geographic location of shipments during transportation.

GPS functionality allows the system to:

* Receive latitude and longitude coordinates
* Associate location data with shipments
* Monitor the current shipment location
* Track movement during transportation
* Display the latest known location
* Combine location information with environmental sensor readings

This allows ShipTrack to monitor both **where the shipment is** and **the condition of the shipment**.

### 🚨 Automated Alerts

ShipTrack automatically detects abnormal sensor conditions.

For example:

* Temperature exceeds the configured maximum
* Temperature falls below the configured minimum
* Abnormal humidity levels
* Excessive tilt
* Unexpected environmental conditions

When a threshold is exceeded, the system automatically creates an alert associated with the relevant sensor reading and shipment.

### 📊 Admin Dashboard

The administrative dashboard provides a centralized view of shipment conditions.

Administrators can monitor:

* Shipment status
* Temperature
* Humidity
* GPS location
* Tilt
* Light
* Active alerts
* Historical sensor readings
* Shipment information

### 🤖 AI Shipment Assistant

ShipTrack includes an AI-powered assistant that allows users to interact with shipment data using natural language.

The assistant can answer questions such as:

* What is the current status of my shipment?
* Where is my shipment currently located?
* What is the latest temperature?
* Are there any active alerts?
* Show me the shipment's recent sensor readings.
* Generate a report for this shipment.

The AI service communicates with the Laravel backend and uses shipment and sensor information from the database to provide contextual responses.

### 📄 PDF Reports

The system can generate shipment reports containing relevant shipment information and monitoring data.

Reports can include:

* Shipment information
* Tracking number
* Origin and destination
* Shipment status
* Sensor readings
* Temperature history
* Humidity history
* GPS information
* Alerts
* Monitoring results

### 📧 Email Notifications

Generated reports can be sent through email as PDF attachments.

This allows shipment information and monitoring reports to be delivered directly to authorized users.

### 🔐 Authorization & Security

ShipTrack restricts access to shipment information according to authenticated users and their authorized shipments.

The system protects:

* Shipment information
* Sensor readings
* GPS data
* Alerts
* Generated reports
* AI shipment information

---

# 🏗️ System Architecture

```text
                         ┌─────────────────────┐
                         │       ESP32         │
                         │                     │
                         │  Temperature        │
                         │  Humidity           │
                         │  GPS                │
                         │  Tilt               │
                         │  Light              │
                         └──────────┬──────────┘
                                    │
                                  Wi-Fi
                                    │
                                    ▼
                         ┌─────────────────────┐
                         │    Laravel API      │
                         │                     │
                         │  Data Validation    │
                         │  Authentication     │
                         │  Alert Detection    │
                         └──────────┬──────────┘
                                    │
                                    ▼
                         ┌─────────────────────┐
                         │     PostgreSQL      │
                         │                     │
                         │ Shipments           │
                         │ Sensor Readings     │
                         │ Alerts              │
                         │ GPS Data            │
                         └──────────┬──────────┘
                                    │
                     ┌──────────────┴──────────────┐
                     │                             │
                     ▼                             ▼
            ┌─────────────────┐           ┌─────────────────┐
            │ Admin Dashboard │           │ AI Assistant    │
            │                 │           │                 │
            │ Live Monitoring │           │ Groq AI         │
            │ GPS             │           │ Natural Language│
            │ Alerts          │           │ Reports         │
            │ Reports         │           └─────────────────┘
            └─────────────────┘
```

---

# 🔌 IoT Architecture

The IoT communication flow is:

```text
Sensors
   │
   ▼
ESP32
   │
   ├── Temperature
   ├── Humidity
   ├── GPS
   ├── Tilt
   └── Light
   │
   ▼
Wi-Fi
   │
   ▼
Laravel REST API
   │
   ▼
Data Validation
   │
   ▼
PostgreSQL
   │
   ├── Sensor Readings
   ├── GPS Coordinates
   └── Alerts
   │
   ▼
Monitoring Dashboard
```

---

# 📡 Sensor Data Flow

The ESP32 periodically collects sensor information and sends it to the Laravel backend.

```text
ESP32 collects data
        ↓
Sensor readings prepared
        ↓
GPS coordinates collected
        ↓
Data sent through Wi-Fi
        ↓
Laravel REST API
        ↓
Validate request
        ↓
Store sensor reading
        ↓
Check thresholds
        ↓
Create alert if necessary
        ↓
Display data on dashboard
```

A typical reading can contain information such as:

```json
{
    "shipment_id": 1,
    "temperature": 33.4,
    "humidity": 62.5,
    "latitude": 33.8938,
    "longitude": 35.5018,
    "tilt": 4.2,
    "light": 120,
    "recorded_at": "2026-08-31 12:30:00"
}
```

---

# 📍 GPS Tracking Flow

GPS data follows the same IoT communication pipeline:

```text
GPS Module
     ↓
ESP32
     ↓
Latitude + Longitude
     ↓
Wi-Fi
     ↓
Laravel API
     ↓
PostgreSQL
     ↓
Shipment Location
     ↓
Dashboard
```

The latest GPS coordinates can be associated with the shipment to determine its current known location.

GPS data can also be combined with sensor readings to provide a complete picture of shipment conditions.

For example:

```text
Shipment
   │
   ├── Location: Beirut
   ├── Temperature: 33.4°C
   ├── Humidity: 62.5%
   ├── Tilt: 4.2°
   └── Light: 120
```

---

# 🚨 Automated Alert Workflow

```text
Sensor Reading
      │
      ▼
Laravel API
      │
      ▼
Validate Reading
      │
      ▼
Check Shipment Thresholds
      │
      ├── Normal
      │      ↓
      │   Store Reading
      │
      └── Abnormal
             ↓
        Create Alert
             ↓
        Store Alert
             ↓
        Display Alert
```

For temperature monitoring, each shipment can define:

```text
Minimum Temperature
Maximum Temperature
```

If the incoming temperature falls outside the allowed range, ShipTrack automatically creates an alert.

---

# 🤖 AI Architecture

ShipTrack integrates **Groq AI** through a Laravel-based AI service.

```text
User
 │
 ▼
AI Chat Interface
 │
 ▼
Laravel Controller
 │
 ▼
AI Service
 │
 ├───────────────┐
 ▼               ▼
PostgreSQL     Groq AI
 │               │
 │               │
 └───────┬───────┘
         ▼
   AI Generated Response
         │
         ▼
      User
```

The AI assistant can access authorized shipment information and provide contextual responses.

### AI Capabilities

* Shipment status questions
* Tracking information
* GPS location information
* Temperature information
* Humidity information
* Sensor history
* Alert information
* Shipment summaries
* Natural-language shipment queries
* Dynamic shipment reports
* PDF report generation
* Emailing generated reports

---

# 📄 Report Generation Workflow

```text
User requests report
        ↓
Laravel Controller
        ↓
Retrieve shipment data
        ↓
Retrieve sensor readings
        ↓
Retrieve GPS information
        ↓
Retrieve alerts
        ↓
Generate PDF
        ↓
Display / Download PDF
        ↓
Optional Email Delivery
```

The report can combine shipment, environmental, GPS, and alert information into a single document.

---

# 🛠️ Technology Stack

## Backend

* **Laravel**
* **PHP**
* **PostgreSQL**
* **REST API**
* **Laravel Queues**
* **Laravel Mail**

## Frontend

* **Blade**
* **JavaScript**
* **Tailwind CSS**
* **HTML5**
* **CSS3**

## IoT

* **ESP32-S3-N16R8**
* **SHT31 Temperature & Humidity Sensor**
* **GPS**
* Tilt sensor
* Light sensor
* Wi-Fi communication

## AI

* **Groq AI**
* Laravel AI service integration

## Reporting

* PDF generation
* Automated report generation
* Email PDF attachments

---

# 🔧 Hardware

### ESP32

The ESP32 acts as the central IoT controller.

Responsibilities include:

* Reading sensor values
* Reading GPS coordinates
* Connecting to Wi-Fi
* Preparing sensor data
* Sending data to Laravel
* Communicating with the backend API

### SHT31

The SHT31 sensor provides:

* Temperature
* Humidity

### GPS

The GPS module provides:

* Latitude
* Longitude
* Shipment location data

### Additional Sensors

ShipTrack also integrates sensors for:

* Tilt
* Light

---

# 🧩 Main Components

## Shipment Management

Responsible for storing and managing:

* Product name
* Tracking number
* Origin
* Destination
* Minimum temperature
* Maximum temperature
* Shipment status

## Sensor Readings

Stores environmental and location information collected from the IoT device.

Example:

```text
Temperature
Humidity
Latitude
Longitude
Tilt
Light
Timestamp
Shipment ID
```

## Alerts

Alerts are generated when abnormal readings are detected.

Alerts are associated with the corresponding sensor readings and shipment.

## Dashboard

Provides administrators with real-time visibility into:

* Shipments
* Sensor readings
* GPS location
* Alerts
* Shipment status

## AI Assistant

Provides natural-language interaction with shipment data.

## Reporting

Generates PDF reports from shipment and monitoring information.

## Notifications

Uses Laravel Mail to send generated reports and relevant notifications.

---

# 📁 Project Structure

```text
ShipTrack/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Requests/
│   │
│   ├── Models/
│   │   ├── Shipment.php
│   │   ├── SensorReading.php
│   │   └── Alert.php
│   │
│   └── Services/
│       └── AI/
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── resources/
│   ├── views/
│   ├── css/
│   └── js/
│
├── routes/
│   ├── web.php
│   └── api.php
│
├── public/
│
├── storage/
│
├── .env
└── README.md
```

---

# 🚀 Getting Started

## Requirements

Before running ShipTrack, install:

* PHP 8.3+
* Composer
* Laravel
* PostgreSQL
* Node.js
* npm
* ESP32 development environment

---

## 1. Clone the Repository

```bash
git clone <YOUR_REPOSITORY_URL>
cd SeniorProject
```

---

## 2. Install PHP Dependencies

```bash
composer install
```

---

## 3. Install Frontend Dependencies

```bash
npm install
```

---

## 4. Configure Environment

Create the `.env` file:

```bash
cp .env.example .env
```

Configure your PostgreSQL database:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=shiptrack
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

Configure the required AI and mail environment variables according to your local setup.

---

## 5. Generate Application Key

```bash
php artisan key:generate
```

---

## 6. Run Database Migrations

```bash
php artisan migrate
```

---

## 7. Build Frontend Assets

```bash
npm run build
```

For development:

```bash
npm run dev
```

---

## 8. Start Laravel

```bash
php artisan serve
```

The application will be available through the Laravel development server.

---

# 📡 ESP32 Setup

The ESP32 is configured to connect to the local Wi-Fi network and communicate with the Laravel API.

The basic process is:

```text
ESP32
  ↓
Connect to Wi-Fi
  ↓
Initialize sensors
  ↓
Read temperature
  ↓
Read humidity
  ↓
Read GPS
  ↓
Read tilt
  ↓
Read light
  ↓
Send HTTP request
  ↓
Laravel API
```

The ESP32 communicates with the Laravel backend using HTTP requests.

Example endpoint:

```text
POST /api/sensor/readings
```

The request contains the latest sensor and GPS information.

---

# 🌐 REST API

The Laravel backend exposes REST API endpoints for IoT communication.

Example:

```http
POST /api/sensor/readings
```

The API is responsible for:

1. Receiving ESP32 data
2. Validating the request
3. Identifying the shipment
4. Storing sensor readings
5. Storing GPS coordinates
6. Checking monitoring thresholds
7. Creating alerts when necessary

---

# 📊 Monitoring Example

| Parameter   | Example |
| ----------- | ------: |
| Temperature |  33.4°C |
| Humidity    |   62.5% |
| Latitude    | 33.8938 |
| Longitude   | 35.5018 |
| Tilt        |    4.2° |
| Light       |     120 |
| Status      |  Normal |

The dashboard can use these readings to provide a real-time overview of shipment conditions and location.

---

# 🔐 Security

ShipTrack uses authentication and authorization mechanisms to protect shipment information.

Important security considerations include:

* Authenticated users
* Authorized shipment access
* API validation
* Protected shipment data
* Protected GPS information
* Secure environment configuration
* Server-side validation
* Controlled AI access to shipment information

Sensitive credentials and API keys should never be committed to the repository.

---

# 📈 Future Improvements

Possible future enhancements include:

* 🗺️ Interactive live GPS maps
* 📍 Complete GPS route history
* 🔴 Real-time shipment movement
* 📡 WebSocket-based live sensor updates
* 📱 Dedicated mobile application
* 📊 Advanced analytics
* 🤖 Predictive shipment risk analysis
* 🔮 Predictive temperature monitoring
* 🧠 Advanced anomaly detection
* 🌎 Multi-shipment live tracking
* 🔔 Push notifications
* 📧 Advanced notification channels
* ☁️ Cloud deployment
* 📈 Historical GPS visualization
* 🚚 Route optimization
* 🤖 More advanced AI shipment analysis

---

# 🎓 Academic Project

ShipTrack was developed as a **Senior / Graduation Project** combining multiple areas of software and computer engineering.

The project demonstrates the integration of:

* Web development
* Backend development
* Database design
* REST API development
* IoT
* Embedded systems
* GPS tracking
* Real-time monitoring
* Automated alerts
* Artificial intelligence
* PDF generation
* Email automation
* Authentication and authorization

The project demonstrates how IoT devices can communicate with a modern web application to monitor shipments and provide actionable information to users.

---


Computer Engineering
Full Stack Web Developer

---

# 📜 License

This project was developed as an academic Senior Project.

All rights reserved unless otherwise specified.
