
# Online Blood Banking System

This project is a **web application** for managing blood donation and requests, including functionalities for both **donors** and **requesters**. It also includes an **admin dashboard** to approve requests and donations.

## Features:
- **Donor Dashboard**: Allows donors to fill in their details and donate blood.
- **Requester Dashboard**: Allows requesters to request specific blood types.
- **Admin Dashboard**: Allows the admin to approve or reject donation and request submissions.

## Prerequisites:
- **Apache2**: Web server
- **PHP**: Server-side scripting language
- **MySQL**: Database management system
- **AWS EC2 (for deployment)**: If deploying on AWS EC2, an EC2 instance should be created.
- **RDS (Optional)**: For using AWS-managed MySQL database.

---

## Local Machine Setup

### 1. **Clone the Repository**
Clone this repository to your local machine:

```bash
git clone https://github.com/ahmed2k2/rhombixtechnologies_tasks.git
cd rhombixtechnologies_tasks/Online_blood_banking_system
```

### 2. **Install Apache2, PHP, and MySQL (if not already installed)**

#### **For Ubuntu:**

1. Install Apache2:
    ```bash
    sudo apt update
    sudo apt install apache2 -y
    ```

2. Install PHP:
    ```bash
    sudo apt install php php-mysql -y
    ```

3. Install MySQL:
    ```bash
    sudo apt install mysql-server -y
    sudo mysql_secure_installation
    ```

#### **For Amazon Linux (EC2):**

1. Install Apache2:
    ```bash
    sudo yum install httpd -y
    ```

2. Install PHP:
    ```bash
    sudo yum install php php-mysqlnd -y
    ```

3. Install MySQL:
    ```bash
    sudo yum install mysql -y
    ```

---

### 3. **Database Setup**
1. **Create a Database:**
    ```bash
    mysql -u root -p
    CREATE DATABASE blood_banking_system;
    ```

2. **Import Database Schema:**
    - Inside the project folder, look for the `database.sql` file (if available).
    - Import the schema into your MySQL database:
    ```bash
    mysql -u root -p blood_banking_system < /path/to/database.sql
    ```

3. **Configure Database Credentials:**
    - Update the `db_config.php` (or equivalent) file with your local database credentials:
    ```php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'your_mysql_password');
    define('DB_DATABASE', 'blood_banking_system');
    ```

---

### 4. **Set Permissions**
Make sure Apache has permission to read and serve your project files:

```bash
sudo chown -R www-data:www-data /var/www/html/
sudo chmod -R 755 /var/www/html/
```

---

### 5. **Access the Project Locally**
Open your browser and visit:
```
http://localhost
```
You should see the **Online Blood Banking System** running locally.

---

## EC2 Setup

### 1. **Launch an EC2 Instance**
- Go to the **AWS EC2 Console** and launch a new instance (choose **Amazon Linux 2** or **Ubuntu**).
- Select instance type (e.g., **t2.micro**).
- Add an **Inbound Rule** for **HTTP (port 80)** and **SSH (port 22)**.
- Create a **key pair** for SSH access.

### 2. **Connect to EC2 Instance**
After launching your instance, connect via SSH using the following command:

```bash
ssh -i /path/to/your-key.pem ec2-user@<ec2-public-ip>
```

Replace `<ec2-public-ip>` with the actual public IP address of your EC2 instance.

---

### 3. **Install Apache2, PHP, and MySQL (If Not Already Installed)**

Follow the same installation steps as above for either **Amazon Linux** or **Ubuntu**.

---

### 4. **Transfer Your Project to EC2**
You can use **SCP** (Secure Copy) to upload your project files to EC2. From your local machine, use the following command:

```bash
scp -i /path/to/your-key.pem -r /path/to/Online_blood_banking_system ec2-user@<ec2-public-ip>:/var/www/html/
```

Alternatively, you can use **FTP** tools like FileZilla to upload the files.

---

### 5. **Set Permissions on EC2**
Set appropriate permissions for the Apache server to access the project files:

```bash
sudo chown -R apache:apache /var/www/html/
sudo chmod -R 755 /var/www/html/
```

---

### 6. **Configure the Database on RDS (Optional)**
If you're using **Amazon RDS** for the database:
1. Launch a **MySQL RDS instance** from the AWS Console.
2. Update the **`db_config.php`** file to point to the RDS endpoint:
    ```php
    define('DB_SERVER', 'your-rds-endpoint');
    define('DB_USERNAME', 'your-db-username');
    define('DB_PASSWORD', 'your-db-password');
    define('DB_DATABASE', 'your-db-name');
    ```

3. Open the **MySQL port** (3306) for your EC2 instance in the RDS security group settings.

---

### 7. **Restart Apache on EC2**

After configuring everything, restart Apache to apply changes:

```bash
sudo service httpd restart  # Amazon Linux
sudo systemctl restart apache2  # Ubuntu
```

---

### 8. **Access Your Project on EC2**
Open a browser and enter the **public IP** of your EC2 instance:
```
http://<ec2-public-ip>
```
You should now be able to access the **Online Blood Banking System**.

---

## Troubleshooting
- If you cannot access the project on **EC2**, make sure your **security groups** allow HTTP traffic (port 80) and SSH (port 22).
- Ensure the **MySQL connection** settings are correct in `db_config.php`.

---

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---


## Contributing  
Feel free to submit issues or pull requests for improvements!  


## Contact  
For any questions, reach out at [raza37487@gmail.com]. 

**Enjoy managing blood donations and requests with your new Online Blood Banking System!** 😊
