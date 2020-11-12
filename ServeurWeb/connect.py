
#fonction qui cherche dans les clients mail et mdp. si correspond -> return mail pour afficher sur client.html
#TODO tester crypter/décrypter mdp pour plus de sécurité sur le csv


def connect(email, password):
    import pandas as pd
    df = pd.read_csv('client.csv')
    if(df['mail'] == email):
        if(df['mdp'] == password):
            return True
        else:
            return False
    else:
        return False