from select import app, db

# Create the database
with app.app_context():
    db.create_all()
    print('Database created')
