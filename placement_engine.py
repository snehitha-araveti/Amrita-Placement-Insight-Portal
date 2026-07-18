import mysql.connector
import sys

# DEBUG: Save errors to a text file in the same folder
sys.stderr = open("python_error_log.txt", "w")

try:
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        password="Snehitha@07",
        database="amrita_placement"
    )
    cursor = db.cursor()

    # Clear old counts
    cursor.execute("DELETE FROM analytics_results")

    # Get company requirements
    cursor.execute("SELECT id, min_cgpa FROM companies")
    companies = cursor.fetchall()

    for (c_id, min_cgpa) in companies:
        # The key logic: count students who meet criteria
        cursor.execute("SELECT COUNT(*) FROM students WHERE cgpa >= %s", (min_cgpa,))
        count = cursor.fetchone()[0]
        
        cursor.execute("INSERT INTO analytics_results (company_id, eligible_count) VALUES (%s, %s)", (c_id, count))

    db.commit()
    db.close()

except Exception as e:
    print(f"Error: {e}")