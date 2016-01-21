# coding:utf-8
from douban_movie import url_manager, html_downloader, html_parser,\
    outputer

class SpiderMain():
    def __init__(self):
        self.urls = url_manager.UrlManager()
        self.downloader = html_downloader.HtmlDownloader()
        self.parser = html_parser.HtmlParser()
        self.outputer = outputer.Outputer()
        
    
    def start(self,start_url):
        self.urls.add_new_url(start_url)
        count = 1;
        while self.urls.has_new_url():
            try:
                new_url = self.urls.get_new_url()
                print('craw %d : %s' %(count,new_url))
                html_cont = self.downloader.download(new_url)
                new_urls,new_data = self.parser.parse(new_url,html_cont)
                self.urls.add_new_urls(new_urls)
                self.outputer.collect_data(new_data)
                #break
                if count == 1000:
                    break;
                count = count + 1
            except:
                print('获取 失败')
                
        self.outputer.output_html()           
        self.outputer.output_json_bypage()    
        print('end')


if __name__ == '__main__':
    start_url = 'https://movie.douban.com/top250'
    spider_main = SpiderMain()
    spider_main.start(start_url)
    






