from flask import Flask, render_template, request

app = Flask(__name__)


@app.route('/')
def hello_world():
    a = 3 + 4
    html = render_template('index.html', a = a)
    return html

app.run(host='localhost', debug=True)