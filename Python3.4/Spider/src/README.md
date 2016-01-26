###简介

----------
此项目为python爬虫的学习测试代码,通过python爬虫获取豆瓣电影Top250部电影的电影名称,简介(包括导演/主演信息),url,图片链接(或者存到本地),评分等信息

###思路
1. 调度器(dispatcher) main
2. Url管理器(UrlManager):
	- 存储url地址,待爬取的url
	- 获取url
3. 网页下载器:负责下载要爬取的url内容
4. 网页解析器:把下载好的url内容进行解析,得到需要的数据



###知识点
1. urllib2
2. BeautifulSoup
3. 