FROM alphacep/kaldi-vosk-server:latest

WORKDIR /opt/vosk-server/websocket
CMD [ "python3", "./asr_server.py", "/opt/vosk-model-ru/model" ]