// app/layout.tsx
import "../fonte.css"; // CSS de fontes
 
export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="pt-BR">
      <head>
        {/* Favicon vazio para remover o ícone do Next.js */}
        <link rel="icon" href="data:,">
      </head>
      <body className="antialiased">
        {children}
      </body>
    </html>
  );
}
 