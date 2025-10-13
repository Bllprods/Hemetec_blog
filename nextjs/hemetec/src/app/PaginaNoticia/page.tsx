import '../fonte.css';
import { redirect } from "next/navigation";
import fs from 'fs';
import path from 'path';
import BackButton from './BackButon'; // Client Component para o botão
 
interface Post {
  id_noticia: number;
  titulo: string;
  subtitulo?: string;
  criado_em: string;
  txt_url: string;
  id_versao?: number;
  imagens?: string[];
  autor: string;
}
 
interface Props {
  searchParams: { id?: string; fromTela?: string };
}
 
// Server-side
export default async function PaginaNoticia({ searchParams }: Props) {
  const { id, fromTela } = searchParams;
 
  // Bloqueia acesso direto
  if (!id || fromTela !== "1") {
    redirect("/TelaNoticias");
  }
 
  // Caminho para o JSON fora da pasta nextjs/hemetec
  const filePath = path.join(process.cwd(), '..', '..', 'data.json'); 
 
  let data: Post[] = [];
  try {
    const jsonData = fs.readFileSync(filePath, 'utf-8');
    data = JSON.parse(jsonData);
  } catch (err) {
    console.error("Erro ao ler JSON:", err);
    return <div id="Corpo" className="body-next">Erro ao carregar a notícia.</div>;
  }
 
  const noticia = data.find(n => n.id_noticia === Number(id));
 
  if (!noticia) return <div id="Corpo" className="body-next">Notícia não encontrada</div>;
 
  return (
    <div id="Corpo" className="body-next" style={{ display: 'flex', justifyContent: 'center', padding: '40px 10px' }}>
      <article
        style={{
          maxWidth: '800px',
          width: '100%',
          backgroundColor: '#fff',
          borderRadius: '12px',
          boxShadow: '0 8px 20px rgba(0,0,0,0.1)',
          padding: '30px',
          display: 'flex',
          flexDirection: 'column',
          gap: '25px',
        }}
      >
        <h1 className="titulo-next" style={{ fontSize: '32px', textAlign: 'center', color: '#111' }}>
          {noticia.titulo}
        </h1>
 
        {noticia.subtitulo && (
          <h2 style={{ textAlign: 'center', color: '#666', fontSize: '20px' }}>
            {noticia.subtitulo}
          </h2>
        )}
 
        <div style={{ textAlign: 'center', color: '#444', fontSize: '14px' }}>
          Publicado em {new Date(noticia.criado_em).toLocaleDateString("pt-BR")} por {noticia.autor}
        </div>
 
        <div style={{ lineHeight: 1.8, fontSize: '16px', color: '#111', display: 'flex', flexDirection: 'column', gap: '16px' }}>
          {noticia.txt_url}
        </div>
 
        {noticia.imagens && noticia.imagens.length > 0 && (
          <>
            <h3>Imagens</h3>
            <ul style={{ padding: 0 }}>
              {noticia.imagens.map((img, index) => (
                <li key={index} style={{ listStyle: 'none', marginBottom: '10px' }}>
                  <img src={img} alt={`Imagem ${index + 1}`} style={{ maxWidth: '100%', borderRadius: '8px' }} />
                </li>
              ))}
            </ul>
          </>
        )}
 
        {/* Botão de voltar funcionando via Client Component */}
        <BackButton />
      </article>
    </div>
  );
}
 