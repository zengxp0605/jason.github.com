from bs4 import BeautifulSoup
from urllib.parse import urljoin
import re

class HtmlParser():
    def _get_new_urls(self,page_url,soup):
        new_urls = set()
        # 仅获取后一页的链接,这里其实只有一个
        links = soup.find('span',class_='next').find_all('a') #,href=re.complie(r"\?start=")
        for link in links:
            new_url = link['href']
            new_full_url = urljoin(page_url,new_url)
            new_urls.add(new_full_url)
            
        return new_urls
     
    def _get_new_data(self,page_url,soup):
        res_datas = []
        
        items = soup.find_all('div',class_='item')

        for item in items:
            res_data = {}
            pic_node = item.find('div',class_='pic')
            res_data['img'] = pic_node.find('img')['src']
            res_data['detail_url'] = pic_node.find('a')['href']
            info_node = item.find('div',class_='info')
            res_data['title'] = info_node.find('span',class_='title').get_text();
            res_data['intro'] = info_node.find('div',class_='bd').find('p').get_text();
            #匹配出年份
            m = re.compile(r'\d{4}')
            years = m.findall(res_data['intro'])
            try:
                res_data['year'] = years[0]
            except:
                res_data['year'] = ''
            res_data['desc'] = info_node.find('div',class_='bd').find('span',class_='inq').get_text()
            res_data['score'] = info_node.find('div',class_='bd').find('span',class_='rating_num').get_text()
            res_datas.append(res_data)
            
        return res_datas
             
        
    
    def parse(self,page_url,html_cont):
        if page_url is None or html_cont is None:
            return
        
        soup = BeautifulSoup(html_cont,'html.parser',from_encoding='utf-8')
        new_urls = self._get_new_urls(page_url,soup)
        new_data = self._get_new_data(page_url,soup)
        return new_urls,new_data
        
