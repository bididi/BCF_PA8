from flask import Flask, render_template, request

from connect import connect  # import de la fonction connection

app = Flask(__name__)


@app.route('/')
def index():
    a = 3 + 4
    html = render_template('index.html', a=a)
    return html


@app.route('/connexion')
def connexion():
    html = render_template('connexion.html')
    return html


@app.route('/client', methods=['POST'])
def client():
    email = request.form['email']
    password = request.form['password']
    #if not connect(email, password):
    #    ErrorHtml = render_template('index.html')
    #    return ErrorHtml
    html = render_template('client.html', email=email)
    return html


@app.route('/inscription')
def inscription():
    html = render_template('inscription.html')
    return html


app.run()(host='localhost', debug=True)
