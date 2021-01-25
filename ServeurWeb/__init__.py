import os
from flask import Flask, render_template, request, redirect, url_for

def create_app(test_config=None):
    # create and configure the app
    app = Flask(__name__, instance_relative_config=True)
    app.config.from_mapping(
        SECRET_KEY='dev',
        DATABASE=os.path.join(app.instance_path, 'flaskr.sqlite'),
    )

    if test_config is None:
        # load the instance config, if it exists, when not testing
        app.config.from_pyfile('config.py', silent=True)
    else:
        # load the test config if passed in
        app.config.from_mapping(test_config)

    # ensure the instance folder exists
    try:
        os.makedirs(app.instance_path)
    except OSError:
        pass

    from . import db
    db.init_app(app)

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

    return app