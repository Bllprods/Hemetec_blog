// app/layout.tsx
import "../../../../../../public/css/style.css";
import "../../fonte.css";
 
export default function RootLayout({
  children,
}: Readonly<{ children: React.ReactNode }>) {
  return (
    <html lang="pt-BR">
      <body className="antialiased">
        {/* Aqui você pode adicionar header/footer globais se quiser */}
        {children}
      </body>
    </html>
  );
}