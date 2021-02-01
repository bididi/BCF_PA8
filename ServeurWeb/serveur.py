#fichier "obsolète", le code marche quand on exécute _init_.py

from flask import Flask, render_template, request, redirect, url_for

app = Flask(__name__)


@app.route('/')
def index():
    html = render_template('index.html')
    return html


@app.route('/connexion')
def connexion():
    html = render_template('connexion.html')
    return html


@app.route('/client', methods=['POST'])
def client():
    email = request.form['email']
    password = request.form['password']
    html = render_template('client.html', email=email)
    return html


@app.route('/inscription')
def inscription():
    html = render_template('inscription.html')
    return html


@app.errorhandler(404)
def page_not_found(error):
    return render_template('page_not_found.html'), 404

app.run()(host='localhost', debug=True)
