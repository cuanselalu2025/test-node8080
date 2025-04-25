FROM ubuntu:22.04

RUN apt-get update && \
    apt-get install -y php curl unzip git nano && \
    apt-get clean

# Install node (optional, kalau kamu masih pakai Node.js di index.js)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Set working dir (Gitpod default)
WORKDIR /workspace

CMD ["bash"]
