module.exports = {
  apps: [
    {
      name: "hemetec",
      cwd: "/home/hemetec/htdocs/hemetec.com.br/nextjs/hemetec",
      script: "npm",
      args: "start",
      exec_mode: "fork",            // cluster também é possível em algumas versões
      instances: 1,
      watch: false,
      env: {
        NODE_ENV: "production",
        PORT: 3000
      },
      // opcional: reiniciar quando consumir muita memória
      max_memory_restart: "512M"
    }
  ]
}

