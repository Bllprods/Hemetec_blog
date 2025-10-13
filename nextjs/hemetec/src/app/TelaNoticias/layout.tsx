// app/layout.tsx
import "../../../../../public/css/Cores.css";
import "../../../../../public/css/style.css";
import "../fonte.css"; // adicionado o CSS de fontes
 
export default function RootLayout({ children, }: Readonly<{ children: React.ReactNode }>) {
  return (
    <html lang="pt-BR">
      <body className="antialiased">
        {/* Aqui você pode adicionar header/footer globais se quiser */}
        {children}
      </body>
    </html>
  );
}