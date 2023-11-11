# Use uma imagem base com Golang
FROM golang:1.12.7

# Defina o diretório de trabalho para o diretório do projeto Go
WORKDIR /go/src/app

# Copie os arquivos do projeto Go para o contêiner
COPY api-gateway/ .

# Instale o dep
RUN go get -u github.com/golang/dep/cmd/dep

# Execute o comando dep ensure para instalar as dependências
RUN dep ensure -v

# Compile o projeto
RUN go build -o main .

# Exponha a porta em que o aplicativo Go será executado
EXPOSE 80

# Defina o comando para iniciar o aplicativo
CMD ["./main"]
