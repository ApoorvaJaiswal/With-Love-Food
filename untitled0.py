
#Writing a script to run NLP on the recipes to find out 3 recipes to be recommended

#importing libraries
import pandas as pd
import numpy as nm
import matplotlib.pyplot as mp

#importing dataset
dataset = pd.read_csv('data.csv', encoding = 'ISO-8859-1');
                     
#cleaning text
titles = dataset['Title']  #we'll work with only titles
newTitles= []
import re
import nltk
nltk.download('stopwords')
from nltk.corpus import stopwords
from nltk.stem.porter import PorterStemmer
ps = PorterStemmer()
for i in range(1,25):
    title = re.sub('[^a-z A-Z]',' ',titles[i])
    title = title.lower()
    title = title.split()
    title = [ps.stem(word) for word in title if not word in set(stopwords.words('english'))]
    title = ' '.join(title)
    newTitles.append(title)
#After doing NLP, find 3 recipes with similar words as in the current recipe
import sys
from sklearn.feature_extraction.text import TfidfVectorizer
tf = TfidfVectorizer(analyzer= 'word', ngram_range=(1,5), stop_words = 'english')
tfidf_matrix = tf.fit_transform(titles)

index = sys.argv[1]
from sklearn.metrics.pairwise import cosine_similarity
ans = cosine_similarity(tfidf_matrix[index:index+1],tfidf_matrix)

