{% extends "layout_xml.php" %}

{% block content %}     
<blog_content>
{% for article in items %}
<article>
<article_ID>{{ article.ID }}</article_ID>
<article_headline>{{ article.title }}</article_headline>
<article_author>{{ article.author }}</article_author>

<article_summary>{{ article.summary }}</article_summary>
<article_link>http://slim.phaziz.com/article/{{ article.ID }}/</article_link>
</article>
{% endfor %}
</blog_content>
   
{% endblock content %}
