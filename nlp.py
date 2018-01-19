#Writing a script to run NLP on the recipes to find out 3 recipes to be recommended

#importing libraries
import pandas as pd
import numpy as nm
import matplotlib.pyplot as mp

#importing dataset
dataset = pd.read_csv('data.csv', encoding = 'ISO-8859-1');
                     
#cleaning text
titles = dataset['Title']  #we'll work with only titles

#After doing NLP, find 3 recipes with similar words as in the current recipe
import sys
from sklearn.feature_extraction.text import TfidfVectorizer
tf = TfidfVectorizer(analyzer= 'word', ngram_range=(1,5), stop_words = 'english')
tfidf_matrix = tf.fit_transform(titles)

index = 24
from sklearn.metrics.pairwise import cosine_similarity
ans = cosine_similarity(tfidf_matrix[index:index+1],tfidf_matrix)
result = []
for i in range(0,25):
    if(ans[0][i] > 0.0):
        result.append(i)
for r in result:
    print (r)