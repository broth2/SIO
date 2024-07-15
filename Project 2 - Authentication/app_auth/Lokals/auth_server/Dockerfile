FROM python:3.8
COPY . /auth_server
WORKDIR /auth_server
RUN pip3 install -r requirements.txt
EXPOSE 5001
CMD ["python", "server.py"]
#CMD ["flask", "run", "--host","172.2.0.4","--port","5001"]